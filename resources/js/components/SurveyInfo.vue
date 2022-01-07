<template>
  <div class="container col-xxl-8 px-4 py-5">
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
          <h6 class="text-center">Legend</h6>
          <Vue3-chart-js class="" v-bind="{ ...pieChart }" />
        </div>
      </div>
      <div class="col-lg-6">
        <h3 class="display-5 fw-bold lh-1 mb-3">
          {{ $route.query.name }}
        </h3>
        <h6 class="text-muted border-top pt-3 border-bottom pb-3">
          Date Created: {{ $filters.formatDate($route.query.created_at) }}
          <br />
          Date Updated: {{ $filters.formatDate($route.query.updated_at) }}
        </h6>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
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
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
import Update from "./Update.vue";
import Delete from "./Delete.vue";

export default {
  name: "SurveyInfo",
  components: {
    Vue3ChartJs,
    Delete,
    Update,
  },
  setup() {
    const pieChart = {
      type: "pie",
      data: {
        labels: [
          "Very Unsatisfied",
          "Unsatisified",
          "Neutral",
          "Satisfited",
          "Very Satisfited",
        ],
        datasets: [
          {
            backgroundColor: [
              "#DD1B16",
              "#E46651",
              "#00D8FF",
              "#41B883",
              "#008000",
            ],
            data: [40, 20, 80, 10, 2],
          },
        ],
      },
    };
    return {
      pieChart,
    };
  },
};
</script>

