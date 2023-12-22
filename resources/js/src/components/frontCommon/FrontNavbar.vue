<template>
  <Navbar>
    <li class="mr-6">
      <router-link :to="{ name: 'home' }" class="text-white hover:text-gray-300"
        >Главная</router-link
      >
    </li>
    <li class="mr-6" v-if="isAdmin">
      <router-link
        :to="{ name: 'admin.dashboard' }"
        class="text-white hover:text-gray-300"
        >Админка</router-link
      >
    </li>
    <li class="mr-6" v-if="user">
      <button
        @click="logout"
        to="/admin"
        class="text-white hover:text-gray-300"
      >
        Выйти
      </button>
    </li>

    <li class="mr-6" v-if="!user">
      <router-link
        :to="{ name: 'login' }"
        class="text-white hover:text-gray-300"
        >Вход</router-link
      >
    </li>
    <li class="mr-6" v-if="!user">
      <router-link
        :to="{ name: 'register' }"
        class="text-white hover:text-gray-300"
        >Регистрация</router-link
      >
    </li>
  </Navbar>
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
  mounted() {
    this.checkUserRole();
  },
  methods: {
    logout() {
      this.$store.dispatch("logout", { router: this.$router });
    },

    async checkUserRole() {
      if (this.$store.user) {
        axios
          .get("/api/user-roles")
          .then((resp) => (this.isAdmin = resp.data.includes("admin")))
          .catch((error) => console.error(error));
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
