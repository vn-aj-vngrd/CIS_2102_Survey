<template>
    <router-view />
    <Footer />
</template>

<script>
import Footer from "./components/Footer.vue";

export default {
    components: {
        Footer,
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    height: 100%;
    height: 100vh;
}

.centered {
    position: fixed;
    top: 45%;
    left: 50%;
    width: 200rem;
    transform: translate(-50%, -50%);
}
</style>
