<template>
  <h6 class="text-center mt-2 text-muted">Legend</h6>
  <Vue3ChartJs id="pieChart" type="pie" :data="dataChart" ref="chartRef" />
  {{ dataChart }}
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
  data() {
    return {
      dataChart: {
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
            data: [1, 2, 3, 4, 5],
          },
        ],
      },
    };
  },
  methods: {
    getData() {
      console.log("getData");
      this.dataChart.datasets[0].backgroundColor[0] = "blue";
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

