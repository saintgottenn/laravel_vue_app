<template>
  <div class="admin">
    <AdminNavbar />
    <router-view></router-view>
  </div>
</template>

<script>
import AdminNavbar from "./AdminNavbar.vue";

export default {
  name: "AdminLayout",
  components: {
    AdminNavbar,
  },
};
</script>

<style></style>
