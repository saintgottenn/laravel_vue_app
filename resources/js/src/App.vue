<template lang="">
    <div>
        <Navbar />
        <router-view></router-view>
    </div>
</template>
<script>
import Navbar from "./components/common/Navbar.vue";

export default {
    name: "App",
    components: {
        Navbar,
    },
};
</script>
<style lang=""></style>
