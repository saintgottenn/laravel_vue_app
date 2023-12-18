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
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
          <h2 class="text-xl font-semibold">{{ article.title }}</h2>
          <button
            @click="editArticle(article.id)"
            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Редактировать
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
    };
  },
  mounted() {
    this.getArticles();
  },
  methods: {
    editArticle(id) {
      this.$router.push({ name: "admin.article.edit", params: { id } });
    },
    getArticles() {
      axios
        .get("/api/articles")
        .then((resp) => {
          this.articles = resp.data;
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style></style>
