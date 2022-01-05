<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#finish"
  >
    Finish
  </button>

  <div
    class="modal fade text-start"
    id="finish"
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
        <div class="modal-body">Thank you for answering the survey.</div>
        <div class="modal-footer">
          <router-link to="/" class="btn btn-primary" @click="closeModal"
            >Return to Home</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Finish",
  props: {
    myclass: String,
  },
  methods: {
    closeModal() {
      $("#finish").modal("hide");
    },
  },
};
</script>
