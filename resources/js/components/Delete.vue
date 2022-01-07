<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    :data-bs-target="`#${modal}`"
  >
    Delete
  </button>

  <div
    class="modal fade text-start"
    :id="modal"
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
        <div class="modal-body">
          Are you sure you want to delete the survey?
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" @click="deleteSurvey">Confirm</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Delete",
  props: {
    myclass: String,
    surveyID: Number,
    modal: String,
  },
  data() {
    return {};
  },
  methods: {
    deleteSurvey() {
      console.log(this.surveyID);
      axios
        .post("delete/" + this.surveyID)
        .then((response) => {
        //   console.log(response);
          this.$router.go();
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
};
</script>
