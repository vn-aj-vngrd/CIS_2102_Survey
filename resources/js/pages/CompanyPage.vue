<template>
  <Header htype="company" />
  <Card />
  <div class="container text-center">
    <Create myclass="btn btn-primary me-2 mb-5" />
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
