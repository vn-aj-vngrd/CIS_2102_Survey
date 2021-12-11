<template>
  <div class="container">
    <header class=" d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" >
      <a href="/" class=" d-flex align-items-center col-md-3 mb-2 mb-md-0 text-muted text-decoration-none" >
        <!-- Logo Here -->
        <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Logo"><use xlink:href="#logo"/></svg> -->
        <b>Survey</b>
      </a>

      <!-- Start - Middle Heading -->
      <ul v-show="htype == 'home'" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li>
          <a class="nav-link px-2 link-secondary">Home</a>
        </li>
      </ul>

      <ul v-show="htype == 'survey'" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" >
        <li>
          <a class="nav-link px-2 link-secondary">Survey</a>
        </li>
      </ul>

      <ul v-show="htype == 'admin'" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" >
        <li>
          <a class="nav-link px-2 link-secondary">Admin</a>
        </li>
      </ul>
      <!-- End - Middle Heading -->


      <!-- Start - Rightmost Heading -->
      <div v-show="htype == 'home'" class="col-md-3 text-end">
        <Login myclass="btn btn-primary me-2" />
        <Signup myclass="btn btn-success" />
      </div>

      <div v-show="htype == 'survey'" class="col-md-3 text-end">
        <Finish myclass="btn btn-outline-primary" />
      </div>

      <div v-show="htype == 'admin'" class="col-md-3 text-end">
        <Logout myclass="btn btn-outline-danger" />
      </div>
      <!-- End - Rightmost Heading -->

    </header>
  </div>
</template>

<script>
import Login from "./Login.vue";
import Signup from "./Signup.vue";
import Finish from "./Finish.vue";
import Logout from "./Logout.vue";

export default {
  name: "Header",
  components: {
    Login,
    Signup,
    Finish,
    Logout,
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
