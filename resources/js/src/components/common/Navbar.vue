<template>
  <nav class="bg-gray-800 text-white p-4">
    <ul class="flex justify-center">
      <li class="mr-6">
        <router-link to="/" class="text-white hover:text-gray-300"
          >Главная</router-link
        >
      </li>
      <li class="mr-6">
        <router-link to="/article" class="text-white hover:text-gray-300"
          >Статья</router-link
        >
      </li>
      <li class="mr-6">
        <router-link to="/admin" class="text-white hover:text-gray-300"
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
        <router-link to="/login" class="text-white hover:text-gray-300"
          >Вход</router-link
        >
      </li>
      <li class="mr-6" v-if="!user">
        <router-link to="/register" class="text-white hover:text-gray-300"
          >Регистрация</router-link
        >
      </li>
    </ul>
  </nav>
</template>
<script>
export default {
  name: "Navbar",
  methods: {
    logout() {
      this.$store.dispatch("logout", { router: this.$router });
    },
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
  },
};
</script>
<style lang=""></style>
