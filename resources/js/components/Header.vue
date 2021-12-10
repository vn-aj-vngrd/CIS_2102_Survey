<template>
  <div class="container">
    <header
      class="
        d-flex
        flex-wrap
        align-items-center
        justify-content-center justify-content-md-between
        py-3
        mb-4
        border-bottom
      "
    >
      <a
        href="/"
        class="
          d-flex
          align-items-center
          col-md-3
          mb-2 mb-md-0
          text-muted text-decoration-none
        "
      >
        <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg> -->
        <b>Survey</b>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li>
          <a href="#" class="nav-link px-2 link-secondary">Home</a>
        </li>
      </ul>

      <div v-show="htype == 'home'" class="col-md-3 text-end">
        <Login myclass="btn btn-primary me-2"/>
        <Signup myclass="btn btn-success" />
      </div>

      <div v-show="htype == 'survey'" class="col-md-3 text-end">
        <Finish myclass="btn btn-outline-primary" />
      </div>
    </header>
  </div>
</template>

<script>
import Login from "./Login.vue";
import Signup from "./Signup.vue";
import Finish from "./Finish.vue";


export default {
  name: "Header",
  components: {
    Login,
    Signup,
    Finish,
  },
  props: {
    htype: String,
  },
};
</script>

<style scoped>
.container {
  margin-top: -1px;
  font-size: 17px;
}
</style>
