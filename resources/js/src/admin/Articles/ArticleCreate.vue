<template>
  <div class="max-w-6xl max-h-full h-full py-16 mx-auto">
    <h1 class="text-4xl mb-4">Создать статью</h1>
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
  name: "ArticleCreate",
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
  methods: {
    async submitArticle() {
      this.errors = null;

      const formData = new FormData();
      formData.append("title", this.title);
      formData.append("image", this.image);
      formData.append("short_description", this.shortDescription);
      formData.append("content", this.content);

      axios
        .post("/api/articles", formData, {
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
