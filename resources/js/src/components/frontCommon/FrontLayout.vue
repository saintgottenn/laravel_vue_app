<template>
  <div class="front">
    <FrontNavbar />
    <div class="px-3">
      <router-view></router-view>
    </div>
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
