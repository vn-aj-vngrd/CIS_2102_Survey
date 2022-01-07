<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#update"
  >
    Update Questions
  </button>

  <div
    class="modal fade text-start"
    id="update"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <b>Survey Questions</b>
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div
            class="mb-3"
            v-for="(question, index) in formData.questions"
            :key="question"
          >
            <label for="question" class="col-form-label"
              >Question {{ index + 1 }}</label
            >
            <input type="text" class="form-control" v-model="question.text" />
            <input
              type="hidden"
              class="form-control"
              v-model="question.questionID"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" @click="updateSurvey">Update</button>
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
  name: "Update",
  props: {
    myclass: String,
    surveyID: Number,
  },
  data() {
    return {
      formData: {
        questions: [],
      },
    };
  },
  methods: {
    getQuestions() {
      // console.log(this.surveyID);
      axios
        .get("getQuestions/" + this.surveyID)
        .then((response) => {
          this.formData.questions = response.data;
          // console.log(response.data);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    updateSurvey() {
      console.log(this.formData);
      axios
        .post("update", this.formData)
        .then((response) => {
          // console.log(response);
          $("#update").modal("hide");
          this.$toast.success(`Survey Successfully Update`, {
            position: "top",
            queue: true,
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getQuestions();
  },
};
</script>
