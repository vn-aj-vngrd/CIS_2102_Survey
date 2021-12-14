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
              <label for="recipient-name" class="col-form-label"
                >Company Name</label
              >
              <input
                type="text"
                class="form-control"
                name="companyName"
                required
              />
            </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label"
                >Email Address</label
              >
              <input type="email" class="form-control" name="email" required />
            </div>

            <div class="mb-3">
              <label for="message-text" class="col-form-label">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
                required
              />
            </div>

            <div class="mb-3">
              <label for="message-text" class="col-form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                name="confirmPassword"
                required
              />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="" @click="signup" class="btn btn-success"
            >Sign Up</a
          >
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
  methods: {
    signup() {
      $("#signup").modal("hide");
    },
  },
};
</script>
