<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#respondent"
  >
    Respondents
  </button>

  <div
    class="modal fade text-start"
    id="respondent"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <b>Respondents</b>
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
            v-for="(respondent, index) in respondents"
            :key="respondent"
          >
            <label for="question" class="col-form-label"
              >Respondent {{ index + 1 }}</label
            >
            <input
              type="text"
              class="form-control"
              v-model="respondent.emailAddress"
              disabled
            />
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

export default {
  name: "Respondent",
  props: {
    myclass: String,
    surveyID: Number,
  },
  data() {
    return {
        respondents: [],
    };
  },
  methods: {
    getRespondents() {
      axios
        .get("getRespondents/" + this.surveyID)
        .then((response) => {
          this.respondents = response.data;
          // console.log(response.data);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  created() {
    this.getRespondents();
  },
};
</script>

