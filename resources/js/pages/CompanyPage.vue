<template>
  <Header htype="company" />
  <Card />
  <div class="container text-center">
    <Create myclass="btn btn-sm btn-primary mt-5" />
    <p class="text-muted mt-2 pb-5">Click button to create a survey.</p>
  </div>
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import Create from "../components/Create.vue";
import Card from "../components/Card.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    Create,
    Card,
    Footer,
  },
};
</script>
