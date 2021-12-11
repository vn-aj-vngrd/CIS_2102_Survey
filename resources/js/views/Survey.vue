<template>
  <Header htype="survey" />
  <div class="container centered">
    <Carousel />
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Carousel from "../components/Carousel.vue";

export default {
  name: "Home",
  components: {
    Header,
    Carousel,
  },
};
</script>

<style scoped>

</style>