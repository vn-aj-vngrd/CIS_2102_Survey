<template>
  <Header htype="company" />
  <SurveyInfo />
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import SurveyInfo from "../components/SurveyInfo.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    SurveyInfo,
    Footer,
  },
};
</script>
