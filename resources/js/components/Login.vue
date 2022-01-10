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
            <p class="text-danger mt-2">{{ errors.email }}</p>
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Password</label>
            <input
              type="password"
              class="form-control"
              name="password"
              v-model="formData.password"
            />
            <p class="text-danger mt-2">{{ errors.pass }}</p>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <p class="text-start text-danger">{{ errors.cred }}</p>
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
      errors: {
        email: "",
        pass: "",
        cred: "",
      },
    };
  },
  methods: {
    login() {
      this.errors.email = "";
      this.errors.pass = "";
      this.errors.cred = "";
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/login", this.formData)
          .then((response) => {
            localStorage.setItem("token", response.data.token);
            localStorage.setItem("id", response.data.id);
            localStorage.setItem("pathname", response.data.name);
            const name = response.data.name;
            this.$router.push({
              name: "company",
              params: { pathname: name },
            });
            $("#login").modal("hide");
          })
          .catch((error) => {
            const errors = error.response.data.errors;

            if (typeof errors.email !== "undefined")
              this.errors.email = errors.email[0];

            if (typeof errors.password !== "undefined")
              this.errors.pass = errors.password[0];

            if (typeof errors.credError !== "undefined")
              this.errors.cred = errors.credError[0];
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
