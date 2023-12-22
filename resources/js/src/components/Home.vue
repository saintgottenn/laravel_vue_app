<template>
  <div>
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
          <h2 class="text-2xl font-semibold">{{ article.title }}</h2>
          <div class="text-sm text-gray-700 font-semibold">
            {{ article.short_description }}
          </div>
          <div class="flex justify-between">
            <router-link
              :to="{ name: 'articles.show', params: { articleId: article.id } }"
              class="mt-2 bg-blue-500 w-full text-center text-white px-4 py-2 rounded hover:bg-blue-600"
            >
              Перейти
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Home",
  data() {
    return {
      articles: [],
    };
  },
  mounted() {
    this.getArticles();
  },
  methods: {
    getArticles() {
      axios
        .get(`/api/articles`)
        .then((resp) => (this.articles = resp.data))
        .catch((error) => console.error(error));
    },
  },
};
</script>
<style lang=""></style>
