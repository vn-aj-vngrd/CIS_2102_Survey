<template>
  <Header htype="company" />

  <div class="container">
    <div class="row" >
      <div class="col-auto mb-5" v-for="index in 7" :key="index">
        <Card />
      </div>
    </div>
  </div>
  <div class="container text-center">
    <Create myclass="btn btn-success me-2 mb-5" />
  </div>
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import Create from "../components/Create.vue";
import Display from "../components/Display.vue";
import Card from "../components/Card.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    Create,
    Display,
    Card,
    Footer,
  },
};
</script>
