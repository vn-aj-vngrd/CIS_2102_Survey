<template>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Survey</h1>
        <p class="col-lg-10 fs-4">
          Hello, Dear Customer, we are now running a survey to determine how we
          can improve our service to you.
        </p>
      </div>

      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Survey Code"
              v-model="formData.surveyCode"
            />
            <label for="floatingInput">Survey Code</label>
          </div>
          <p class="text-start text-danger">{{ errors.surveyCode }}</p>

          <div class="form-floating mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Email Address"
              v-model="formData.email"
            />
            <label for="floatingInput">Email Address</label>
          </div>
          <p class="text-start text-danger">{{ errors.email }}</p>
          <p class="text-start text-danger">{{ errors.validation }}</p>

          <button @click="validateAccess" class="w-100 btn btn-lg btn-primary">
            Get Started
          </button>
          <hr class="my-4" />
          <small class="text-muted"></small>
        </form>
      </div>
    </div>
  </div>
  <div class="h6 text-muted text-center mb-4">
    Wanna gather reviews for your company?
    <Login myclass="btn btn-outline-primary ms-2 me-2" />
    <Signup myclass="btn btn-outline-success" />
  </div>
</template>

<script>
import Login from "../components/Login.vue";
import Signup from "../components/Signup.vue";
export default {
  name: "Landing",
  components: {
    Login,
    Signup,
  },
  data() {
    return {
      formData: {
        surveyCode: "",
        email: "",
        device_name: "browser",
      },
      errors: {
        surveyCode: "",
        email: "",
        validation: "",
      },
    };
  },
  methods: {
    validateAccess() {
      this.errors.surveyCode = "";
      this.errors.email = "";

      // console.log(this.formData);
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/registerRespondent", this.formData)
          .then((response) => {
            // console.log(response);
            localStorage.setItem("token", response.data.token);
            localStorage.setItem("responseSetID", response.data.responseSetID);
            localStorage.setItem("pathname", response.data.name);
            localStorage.setItem("surveyName", response.data.surveyName);
            localStorage.setItem("surveyID", response.data.surveyID);
            localStorage.setItem("tokenType", "customer");


            const name1 = localStorage.getItem("pathname");
            const name2 = localStorage.getItem("surveyName");

            this.$router.push({
              name: "customer",
              params: { pathname: name1, surveyname: name2 },
            });
            $("#landing").modal("hide");
          })
          .catch((error) => {
            // console.log(error.response.data.errors);
            const errors = error.response.data.errors;

            if (typeof errors.surveyCode !== "undefined")
              this.errors.surveyCode = errors.surveyCode[0];

            if (typeof errors.email !== "undefined")
              this.errors.email = errors.email[0];
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
