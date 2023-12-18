<template>
  <Navbar>
    <li class="mr-6">
      <router-link :to="{ name: 'home' }" class="text-white hover:text-gray-300"
        >Сайт</router-link
      >
    </li>
    <li class="mr-6">
      <router-link
        :to="{ name: 'admin.dashboard' }"
        class="text-white hover:text-gray-300"
        >Dashboard</router-link
      >
    </li>
    <li class="mr-6">
      <router-link
        :to="{ name: 'admin.articles' }"
        class="text-white hover:text-gray-300"
        >Статьи</router-link
      >
    </li>
    <li class="mr-6">
      <button
        @click="logout"
        to="/admin"
        class="text-white hover:text-gray-300"
      >
        Выйти
      </button>
    </li>
  </Navbar>
</template>

<script>
import Navbar from "../../common/Navbar.vue";
export default {
  name: "AdminNavbar",
  components: {
    Navbar,
  },
  methods: {
    logout() {
      this.$store.dispatch("logout", { router: this.$router });
    },
  },
};
</script>

<style></style>
