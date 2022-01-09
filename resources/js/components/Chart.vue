<template>
  <h6 class="text-center mt-2 text-muted">Legend</h6>
  <Vue3ChartJs v-bind="{ ...pieChart }" ref="chartRef" />
  <h6 class="text-center mt-3 fw-bold text-muted">Total Responses: {{ this.responses }}</h6>
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
import { ref } from "vue";

export default {
  name: "Chart",
  props: {
    surveyID: Number,
    present: String,
  },
  components: {
    Vue3ChartJs,
  },
  setup() {
    const chartRef = ref(null);
    const pieChart = {
      type: "pie",
      data: {
        labels: [
          "Very Satisfied",
          "Satisfied",
          "Neutral",
          "Unsatisified",
          "Very Unsatisfied",
        ],
        datasets: [
          {
            backgroundColor: [],
            data: [0, 0, 0, 0, 0],
          },
        ],
      },
    };

    const initializeChart = (data) => {
      pieChart.data.datasets = [
        {
          backgroundColor: [
            "#008000",
            "#41B883",
            "#00D8FF",
            "#E46651",
            "#DD1B16",
          ],
          data: [data[0], data[1], data[2], data[3], data[4]],
        },
      ];
      chartRef.value.update(750);
    };

    return {
      pieChart,
      chartRef,
      initializeChart,
    };
  },
  data() {
    return {
      data: [0, 0, 0, 0, 0],
      responses: Number,
    };
  },
  mounted() {
    if (this.present === "summary") {
      axios
        .get("getData/" + this.surveyID)
        .then((response) => {
          let res = response.data;
          this.responses = res.data.length / res.count;
          let data = [0, 0, 0, 0, 0];
          for (let i = 0; i < res.data.length; i++) {
            data[res.data[i].rating - 1]++;
          }
          this.initializeChart(data);
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>

