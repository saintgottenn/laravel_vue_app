<template>
  <div class="front">
    <FrontNavbar />
    <router-view></router-view>
  </div>
</template>

<script>
import FrontNavbar from "./FrontNavbar.vue";

export default {
  name: "FrontLayout",
  components: {
    FrontNavbar,
  },
};
</script>

<style></style>
