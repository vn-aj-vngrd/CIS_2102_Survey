<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#logout"
  >
    Log Out
  </button>

  <div
    class="modal fade text-start"
    id="logout"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Survey</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">Are you sure you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-outline-danger" @click="logout">
            Log Out
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Logout",
  props: {
    myclass: String,
  },
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    logout() {
      axios
        .post("api/logout")
        .then((response) => {
          localStorage.removeItem("token");
          localStorage.removeItem("pathname");
          this.$router.push("/");
          $("#logout").modal("hide");
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  mounted() {
    axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
  },
};
</script>
