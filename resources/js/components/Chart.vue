<template>
  <h6 class="text-center">Legend</h6>
  <Vue3-chart-js class="" v-bind="{ ...pieChart }" />
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";

export default {
  name: "Chart",
  components: {
    Vue3ChartJs,
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
  data() {
    return {};
  },
  methods: {},
  mounted() {},
};
</script>

