<template>
  <div class="max-w-6xl max-h-full h-full pt-16 mx-auto">
    <h1>Создать статью</h1>
    <form @submit.prevent="submitArticle">
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2"
          >Заголовок:</label
        >
        <input
          v-model="title"
          type="text"
          id="title"
          name="title"
          class="w-full border p-2"
        />
      </div>
      <div class="mb-4">
        <label for="image" class="block text-gray-700 font-bold mb-2"
          >Изображение URL:</label
        >
        <input
          v-model="image"
          type="text"
          id="image"
          name="image"
          class="w-full border p-2"
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Текст статьи:</label>
        <QuillEditor
          theme="snow"
          v-model="content"
          v-model:content="content"
          toolbar="full"
          contentType="html"
        />
      </div>
      <div v-if="errors" class="mt-3 text-red-600">
        <ul>
          <li v-for="(errorMessages, field) in errors" :key="field">
            <ul>
              <li v-for="message in errorMessages" :key="message">
                {{ message }}
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <button
        type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Сохранить
      </button>
    </form>
  </div>
</template>
<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
  name: "ArticleCreate",
  components: {
    QuillEditor,
  },
  data() {
    return {
      title: "",
      image: "",
      content: "",
      errors: null,
    };
  },
  methods: {
    async submitArticle() {
      console.log(axios.defaults.headers);
      this.errors = null;

      const articleData = {
        title: this.title,
        image: this.image,
        content: this.content,
      };

      axios
        .post("/api/articles", articleData)
        .then(() => {
          this.$router.push({ name: "admin.articles" });
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
<style></style>
