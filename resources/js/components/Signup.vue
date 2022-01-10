<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#signup"
  >
    Sign up
  </button>

  <div
    class="modal fade text-start"
    id="signup"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Sign Up</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="col-form-label">Company Name</label>
              <input
                type="text"
                class="form-control"
                name="companyName"
                v-model="formData.name"
                required
              />
              <p class="text-danger mt-2">{{ errors.name }}</p>
            </div>

            <div class="mb-3">
              <label for="email" class="col-form-label">Email Address</label>
              <input
                type="email"
                class="form-control"
                name="email"
                v-model="formData.email"
                required
              />
              <p class="text-danger mt-2">{{ errors.email }}</p>
            </div>

            <div class="mb-3">
              <label for="password" class="col-form-label">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
                v-model="formData.password"
                required
              />
              <p class="text-danger mt-2">{{ errors.pass1 }}</p>
            </div>

            <div class="mb-3">
              <label for="confirm-password" class="col-form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                name="confirmPassword"
                v-model="formData.password_confirmation"
                required
              />
              <p class="text-danger mt-2">{{ errors.pass2 }}</p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button @click="signup" class="btn btn-success">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Signup",
  props: {
    myclass: String,
  },
  data() {
    return {
      formData: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: {
        name: "",
        email: "",
        pass1: "",
        pass2: "",
      },
    };
  },
  methods: {
    signup() {
      this.errors.name = "";
      this.errors.email = "";
      this.errors.pass1 = "";
      this.errors.pass2 = "";

      axios
        .post("api/signup", this.formData)
        .then((response) => {
          // console.log(response.data);
          this.formData.name =
            this.formData.email =
            this.formData.password =
            this.formData.password_confirmation =
              "";
          this.errors = {};
          $("#signup").modal("hide");
          this.$toast.success(`Account Successfully Created`, {
            position: "top",
            queue: true,
          });
        })
        .catch((error) => {
          // console.log(error.response.data.errors);
          const errors = error.response.data.errors;

          if (typeof errors.name !== "undefined")
            this.errors.name = errors.name[0];

          if (typeof errors.email !== "undefined")
            this.errors.email = errors.email[0];

          if (typeof errors.password !== "undefined")
            this.errors.pass1 = errors.password[0];

          if (typeof errors.password_confirmation !== "undefined")
            this.errors.pass2 = errors.password_confirmation[0];
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

