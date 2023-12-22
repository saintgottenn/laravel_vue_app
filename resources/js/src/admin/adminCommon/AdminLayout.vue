<template>
  <div class="admin">
    <AdminNavbar />
    <div class="px-3">
      <router-view></router-view>
    </div>
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
