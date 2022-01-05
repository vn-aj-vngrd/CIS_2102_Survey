<template>
  <Header htype="survey" />
  <div class="container">
    <Carousel />
  </div>
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import Carousel from "../components/Carousel.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    Carousel,
    Footer,
  },
};
</script>
