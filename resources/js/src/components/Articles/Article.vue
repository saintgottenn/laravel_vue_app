<template>
  <div class="max-w-4xl mx-auto py-16">
    <h1 class="text-5xl">{{ title }}</h1>
    <div class="text-sm mt-4">{{ date }}</div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700" />

    <div v-html="content"></div>
  </div>
</template>

<script>
export default {
  name: "Article",
  props: ["articleId"],
  data() {
    return {
      content: "",
      title: "",
      image: "",
      date: "",
    };
  },
  mounted() {
    this.getArticle(this.articleId);
  },
  methods: {
    getArticle(articleId) {
      axios
        .get(`/api/articles/${articleId}`)
        .then((resp) => {
          this.content = resp.data.content;
          this.title = resp.data.title;
          this.image = resp.data.image;
          this.date = resp.data.created_at;
        })
        .catch((error) => console.error(error));
    },
  },
};
</script>

<style></style>
