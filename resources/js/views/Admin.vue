<template>
  <Header htype="admin" />
  <div class="container ">
      <Create myclass="btn btn-primary me-3"/>
      <Display myclass="btn btn-success"/>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Create from "../components/Create.vue";
import Display from "../components/Display.vue";

export default {
  name: "Home",
  components: {
    Header,
    Create,
    Display,
  },
};
</script>
