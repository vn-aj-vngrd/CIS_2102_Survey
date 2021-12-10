<template>
  <Header htype="home" />
  <div class="centered">
    <Landing />
    <div class="h6 text-muted mb-4">Wanna gather reviews for your company?</div>
    <Login myclass="btn btn-outline-primary ms-2 me-2" />
    <Signup myclass="btn btn-outline-success" />
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Login from "../components/Login.vue";
import Signup from "../components/Signup.vue";
import Landing from "../components/Landing.vue";

export default {
  name: "Home",
  components: {
    Header,
    Landing,
    Login,
    Signup,
  },
};
</script>
