<template>
  <router-view></router-view>
</template>

<script>
import Header from "./components/Header.vue";
import Landing from "./components/Landing.vue";
import Footer from "./components/Footer.vue";

export default {
  components: {
    Header,
    Landing,
    Footer,
  },
};
</script>
