<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#response"
  >
    View Responses
  </button>

  <div
    class="modal fade text-start"
    id="response"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <b>View Responses</b>
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
            <input
              type="text"
              class="form-control"
              v-model="question.text"
              disabled
              required
            />
            <input
              type="hidden"
              class="form-control"
              v-model="question.questionID"
            />
            <Chart :surveyID="surveyID" present="summary" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from "./Chart.vue";

export default {
  name: "Response",
  components: {
    Chart,
  },
  props: {
    myclass: String,
    surveyID: Number,
  },
  data() {
    return {
      formData: {
        id: Number,
        name: String,
        questions: [],
      },
    };
  },
  methods: {
    getQuestions() {
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
  },
  created() {
    this.formData.id = this.surveyID;
    this.getQuestions();
  },
};
</script>

<style scoped>
.modal-dialog {
  max-width: 40rem;
}
</style>