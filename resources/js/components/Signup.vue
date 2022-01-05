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
              <p class="text-danger mt-2" v-text="errors.name"></p>
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
              <p class="text-danger mt-2" v-text="errors.email"></p>
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
              <p class="text-danger mt-2" v-text="errors.password"></p>
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
              <p class="text-danger mt-2" v-text="errors.password_confirmation"></p>
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
      errors: {},
    };
  },
  methods: {
    signup() {
      axios
        .post("api/register", this.formData)
        .then((response) => {
          console.log(response.data);
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
        .catch((errors) => {
          this.errors = errors.response.data.errors;
          console.log(errors.response.data.errors);
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

