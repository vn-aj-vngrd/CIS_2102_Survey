<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#login"
  >
    Log in
  </button>

  <div
    class="modal fade text-start"
    id="login"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Log In</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"
              >Email Address</label
            >
            <input
              type="email"
              class="form-control"
              name="email"
              v-model="formData.email"
            />
            <p class="text-danger mt-2">{{ this.emailError }}</p>
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Password</label>
            <input
              type="password"
              class="form-control"
              name="password"
              v-model="formData.password"
            />
            <p class="text-danger mt-2">{{ this.passError }}</p>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <p class="text-start text-danger">{{ this.credError }}</p>
          <button @click="login" class="btn btn-primary">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  props: {
    myclass: String,
  },
  data() {
    return {
      formData: {
        email: "",
        password: "",
        device_name: "browser",
      },
      errors: {},
      emailError: "",
      passError: "",
      credError: "",
    };
  },
  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/login", this.formData)
          .then((response) => {
            localStorage.setItem("token", response.data.token);
            localStorage.setItem("pathname", response.data.name);
            const name = response.data.name;
            this.$router.push({
              name: "company",
              params: { pathname: name },
            });
            $("#login").modal("hide");
          })
          .catch((errors) => {
            this.errors = errors.response.data.errors;
            if (typeof this.errors.email === "undefined") this.emailError = "";
            else this.emailError = this.errors.email[0];

            if (typeof this.errors.password === "undefined")
              this.passError = "";
            else this.passError = this.errors.password[0];

            if (typeof this.errors.credError === "undefined")
              this.credError = "";
            else this.credError = this.errors.credError[0];
          });
      });
    },
  },
};
</script>

<style scoped>
p {
  font-size: 13px;
}
</style>
