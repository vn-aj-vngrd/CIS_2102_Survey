<template>
    <Header htype="admin" />
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
