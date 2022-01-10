<template>
  <Header htype="survey" />
  <div class="container mb-5 centered">
    <Question />
  </div>
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import Question from "../components/Question.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    Question,
    Footer,
  },
};
</script>

<style>
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
</style>
