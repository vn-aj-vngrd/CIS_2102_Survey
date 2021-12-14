<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#display"
  >
    View Survey
  </button>

  <div
    class="modal fade text-start"
    id="display"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>View Survey</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <!-- Note: Content Here -->
        </div>
        <div class="modal-footer">
          <a to="/" @click="returnHome" class="btn btn-danger"
            >Close</a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Display",
  props: {
    myclass: String,
  },
  methods: {
    returnHome() {
      $("#display").modal("hide");
    },
  },
};
</script>
