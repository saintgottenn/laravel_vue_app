<template>
  <div class="max-w-4xl mx-auto py-16">
    <h1 class="text-5xl">{{ title }}</h1>
    <div class="text-sm mt-4">{{ date }}</div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700" />

    <div v-html="content"></div>

    <div v-if="user">
      <h2 class="text-2xl mt-8">Оставить комментарий</h2>
      <form @submit.prevent="submitComment">
        <div class="mb-4">
          <label for="comment" class="block text-sm font-medium text-gray-700"
            >Комментарий</label
          >
          <textarea
            id="comment"
            v-model="newComment"
            name="comment"
            rows="4"
            class="form-input border-2 border-gray-900 p-2 mt-1 block w-full"
          ></textarea>
        </div>
        <div>
          <button
            type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
          >
            Отправить
          </button>
        </div>
      </form>
    </div>
    <div v-else-if="!user" class="mt-16">
      <router-link
        :to="{ name: 'login' }"
        class="text-blue-500 hover:text-blue-700"
        >Войдите</router-link
      >, чтобы оставить комментарий
    </div>
    <div class="mt-8">
      <h2 class="text-2xl">Все комментарии</h2>
      <ul v-if="comments.length">
        <li
          v-for="comment in comments"
          :key="comment.id"
          class="comment-item border border-gray-600 my-4"
        >
          <div class="p-2">
            <div class="text-sm font-medium text-gray-700">
              Автор: {{ comment.user.name }}
            </div>
            <div class="text-xs mt-2 text-gray-500">
              {{ comment.created_at }}
            </div>
          </div>
          <hr class="my-1 border-t border-gray-300" />
          <div class="text-gray-600 text-lg p-2">{{ comment.content }}</div>
        </li>
      </ul>
      <div
        class="text-center text-gray-500 mt-16 text-xl"
        v-else-if="!comments.length"
      >
        Тут пусто. Будьте первым, кто оставит комментарий!
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../../common/Navbar.vue";
export default {
  components: {
    Navbar,
  },
  data() {
    return {
      isAdmin: false,
    };
  },
  watch: {
    "$store.state.authToken": {
      immediate: true,
      handler(token) {
        this.checkUserRole();
      },
    },
  },
  methods: {
    logout() {
      this.$store.dispatch("logout", { router: this.$router });
    },

    async checkUserRole() {
      if (this.$store.state.authToken) {
        axios
          .get("/api/user-roles")
          .then((resp) => (this.isAdmin = resp.data.includes("admin")))
          .catch((error) => console.error(error));
      } else {
        this.isAdmin = false;
      }
    },
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
};
</script>

<style></style>
