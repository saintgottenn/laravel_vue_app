<template>
  <div class="max-w-6xl py-16 max-h-full h-full pt-16 mx-auto">
    <h1 class="text-4xl mb-4">Редактирование статьи</h1>
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
          >Изображение:</label
        >
        <img
          v-if="previewImage"
          :src="previewImage"
          alt="Предпросмотр изображения"
          class="w-64 h-64 object-cover mb-4"
        />

        <input
          type="file"
          id="image"
          name="image"
          accept="image/*"
          @change="handleImageUpload"
          class="w-full border p-2"
        />
      </div>
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2"
          >Короткое описание:</label
        >
        <input
          v-model="shortDescription"
          type="text"
          id="title"
          name="title"
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
      <div v-if="errors" class="my-3 text-red-600">
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
  name: "ArticleEdit",
  props: ["articleId"],
  components: {
    QuillEditor,
  },
  data() {
    return {
      title: "",
      image: "",
      content: "",
      shortDescription: "",
      errors: null,
      previewImage: null,
    };
  },
  mounted() {
    this.getArticle(this.articleId);
  },
  methods: {
    async getArticle(articleId) {
      axios
        .get(`/api/articles/${articleId}`)
        .then((resp) => {
          this.title = resp.data.title;
          this.previewImage = resp.data.image;
          this.image = resp.data.image;
          this.shortDescription = resp.data.short_description;
          this.content = resp.data.content;
        })
        .catch((error) => console.error(error));
    },

    async submitArticle() {
      this.errors = null;

      const formData = new FormData();
      formData.append("_method", "PUT");
      formData.append("title", this.title);
      formData.append("image", this.image);
      formData.append("content", this.content);
      formData.append("short_description", this.shortDescription);

      axios
        .post(`/api/articles/${this.articleId}`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(() => {
          this.$router.push({ name: "admin.articles" });
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },

    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.previewImage = URL.createObjectURL(file);
        this.image = file;
      }
    },
  },
};
</script>
<style></style>
