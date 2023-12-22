<template>
  <div>
    <router-link
      :to="{ name: 'admin.articles.create' }"
      class="bg-blue-500 text-white mx-4 mt-4 inline-block p-4 mt-4 ml-4 rounded hover:bg-blue-600"
    >
      Добавить статью
    </router-link>

    <div class="p-4">
      <div
        v-if="articles.length === 0"
        class="text-center text-gray-500 text-xl"
      >
        Тут пусто
      </div>
      <div v-else>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div
            v-for="article in articles"
            :key="article.id"
            class="bg-white shadow-lg p-4"
          >
            <img
              :src="article.image"
              alt="Изображение статьи"
              class="w-full h-40 object-cover mb-4"
            />
            <h2 class="text-2xl font-semibold">{{ article.title }}</h2>
            <div class="text-sm text-gray-700 font-semibold">
              {{ article.short_description }}
            </div>
            <div class="flex justify-between">
              <button
                @click="editArticle(article.id)"
                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
              >
                Редактировать
              </button>
              <router-link
                :to="{
                  name: 'articles.show',
                  params: { articleId: article.id },
                }"
                class="mt-2 flex items-center underline text-blue-500"
              >
                Перейти
              </router-link>
              <button
                @click="deleteArticle(article.id)"
                class="mt-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
              >
                Удалить
              </button>
            </div>
          </div>
        </div>
        <div class="text-center mt-16" v-if="next_page_url || prev_page_url">
          <button
            @click="loadPage(prev_page_url)"
            :disabled="!prev_page_url"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"
          >
            ⇐
          </button>
          <span class="py-2 px-4 bg-gray-300 text-gray-800">{{ page }}</span>
          <button
            @click="loadPage(next_page_url)"
            :disabled="!next_page_url"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
          >
            ⇒
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Articles",

  data() {
    return {
      articles: [],
      page: 1,
      prev_page_url: null,
      next_page_url: null,
    };
  },
  mounted() {
    if (this.$route.query.page) {
      this.page = this.$route.query.page;
    }

    this.loadPage(`/api/articles?page=${this.page}`);
  },
  methods: {
    editArticle(articleId) {
      this.$router.push({
        name: "admin.articles.edit",
        params: { articleId },
      });
    },
    deleteArticle(articleId) {
      axios
        .delete(`/api/articles/${articleId}`)
        .then(() => {
          this.articles = this.articles.filter(
            (article) => article.id != articleId
          );
        })
        .catch((error) => console.error(error));
    },
    loadPage(url) {
      axios
        .get(url)
        .then((resp) => {
          this.articles = resp.data.articles;
          this.next_page_url = resp.data.next_page_url;
          this.prev_page_url = resp.data.prev_page_url;
          this.page = resp.data.current_page;

          this.$router.push({
            name: "admin.articles",
            query: { page: this.page },
          });
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style></style>
