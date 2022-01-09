<template>
  <h6 class="text-center mt-2 text-muted">Legend</h6>
  <Vue3ChartJs
    :id="pieChart.id"
    :type="pieChart.type"
    :data="pieChart.data"
    @before-render="beforeRenderLogic"
  />
  <h6 class="text-center mt-3 fw-bold">{{ title }}</h6>
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";

export default {
  name: "Chart",
  props: {
    title: String,
    surveyID: Number,
    present: String,
  },
  components: {
    Vue3ChartJs,
  },
  setup(props) {
    const pieChart = {
      id: "pieChart",
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
            data: [],
          },
        ],
      },
    };

    const beforeRenderLogic = (event) => {
      console.log(props.surveyID);
    };

    return {
      pieChart,
      beforeRenderLogic,
    };
  },
};
</script>

