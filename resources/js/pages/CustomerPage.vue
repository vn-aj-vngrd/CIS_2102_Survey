<template>
  <Header htype="survey" />
  <div class="container mb-5 mt-5">
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


