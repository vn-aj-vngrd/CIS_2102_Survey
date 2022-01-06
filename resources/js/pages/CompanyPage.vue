<template>
  <Header htype="company" />
  <div class="container text-center">
    <Create myclass="btn btn-success me-2" />
    <Display myclass="btn btn-primary" />
  </div>
  <Footer />
</template>

<script>
import Header from "../components/Header.vue";
import Create from "../components/Create.vue";
import Display from "../components/Display.vue";
import Footer from "../components/Footer.vue";

export default {
  components: {
    Header,
    Create,
    Display,
    Footer,
  },
};
</script>
