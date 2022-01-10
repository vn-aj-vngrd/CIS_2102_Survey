<template>
  <div class="container col-xxl-8 px-4">
    <div
      class="
        row
        flex-lg-row-reverse
        align-items-center
        justify-content-center
        g-5
        py-5
      "
    >
      <div class="col-10 col-sm-8 col-lg-6">
        <div class="container">
          <Chart
            :surveyID="parseInt($route.query.surveyID)"
            present="all"
          />
        </div>
      </div>
      <div class="col-lg-6">
        <h3 class="display-5 fw-bold lh-1 mb-3">
          {{ survey.name }}
        </h3>
        <h6 class="text-muted border-top pt-3 border-bottom pb-3">
          Date Created:
          {{ $filters.formatDate(survey.created_at) }}
          <br />
          Date Updated:
          {{ $filters.formatDate(survey.updated_at) }}
        </h6>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
          <Response
            myclass="btn btn-outline-success btn-sm px-4 me-md-2"
            :surveyID="parseInt($route.query.surveyID)"
          />
          <Update
            myclass="btn btn-outline-primary btn-sm px-4 me-md-2"
            :surveyID="parseInt($route.query.surveyID)"
          />
          <Delete
            myclass="btn btn-outline-danger btn-sm btn-lg px-4"
            :surveyID="parseInt($route.query.surveyID)"
            :modal="`modal${$route.query.surveyID}`"
            :routeNum="parseInt(-1)"
          />
        </div>
      </div>
    </div>
  </div>
  <div class="container text-center pb-5">
    <button @click="$router.go(-1)" class="btn btn-secondary btn-sm">
      Go Back
    </button>
    <p class="text-muted pt-2">Click button to go back to main page.</p>
  </div>
</template>

<script>
import Chart from "./Chart.vue";
import Response from "./Response.vue";
import Update from "./Update.vue";
import Delete from "./Delete.vue";

export default {
  name: "SurveyInfo",
  components: {
    Chart,
    Response,
    Delete,
    Update,
  },
  data() {
    return {
      survey: {},
    };
  },
  methods: {
    getSurveyInfo() {
      // console.log(this.$route.query.surveyID)
      axios
        .get("getSurveyInfo/" + this.$route.query.surveyID)
        .then((response) => {
          this.survey = response.data[0];
          // console.log(this.survey);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  created() {
    this.getSurveyInfo();
  },
};
</script>

