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
      <router-link
        to="/"
        class="
          d-flex
          align-items-center
          col-md-3
          mb-2 mb-md-0
          text-muted text-decoration-none
        "
      >
        <!-- Logo Here -->
        <img
          src="../../css/img/logo.png"
          alt="logo"
          width="30"
          height="24"
          class="me-3"
        />
        <b>Survey</b>
      </router-link>

      <!-- Start - Middle Heading -->
      <ul
        v-show="htype == 'home'"
        class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"
      >
        <li>
          <a class="nav-link px-2 link-secondary">Home</a>
        </li>
      </ul>

      <ul
        v-show="htype == 'survey'"
        class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"
      >
        <li>
          <a class="nav-link px-2 link-secondary">{{ this.name }}</a>
        </li>
      </ul>

      <ul
        v-show="htype == 'company'"
        class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"
      >
        <li>
          <a class="nav-link px-2 link-secondary">{{ this.name }}</a>
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

      <div v-show="htype == 'company'" class="col-md-3 text-end">
        <Logout myclass="btn btn-danger" />
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
  data() {
    return {
      name: String,
    };
  },
  mounted() {
    this.name = localStorage.getItem("pathname");
  },
};
</script>

<style scoped>
.container {
  margin-top: -1px;
  font-size: 17px;
}
</style>
