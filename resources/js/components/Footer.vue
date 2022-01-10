<template>
  <footer class="footer bg-white">
    <h6 class="text-muted border-top border-2 pt-2">
      © {{ new Date().getFullYear() }}. Survey Co.
    </h6>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
};
</script>

<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
}
</style>
