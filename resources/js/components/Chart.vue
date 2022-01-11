<template>
  <h6 class="text-center mt-2 text-muted">Legend</h6>
  <Vue3ChartJs v-bind="{ ...pieChart }" ref="chartRef" />
  <h6 class="text-center mt-3 text-muted">
    Total Respondents: {{ this.respondents }} | Total Ratings:
    {{ this.ratings }}
  </h6>
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
import { ref } from "vue";
import ChartJSPluginDatalabels from "chartjs-plugin-datalabels";

export default {
  name: "Chart",
  props: {
    surveyID: Number,
    present: String,
    counter: Number,
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
      options: {
        plugins: {
          tooltip: {
            enabled: true,
            callbacks: {
              footer: (ttItem) => {
                let sum = 0;
                let dataArr = ttItem[0].dataset.data;
                dataArr.map((data) => {
                  sum += Number(data);
                });

                let percentage =
                  ((ttItem[0].parsed * 100) / sum).toFixed(2) + "%";
                return `Percentage of data: ${percentage}`;
              },
            },
          },
          datalabels: {
            formatter: (value, dnct1) => {
              let sum = 0;
              let dataArr = dnct1.chart.data.datasets[0].data;
              dataArr.map((data) => {
                sum += Number(data);
              });

              let percentage = ((value * 100) / sum).toFixed(2) + "%";
              return percentage;
            },
            color: "#ff3",
          },
        },
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
          data: [data[4], data[3], data[2], data[1], data[0]],
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
      respondents: 0,
      ratings: 0,
    };
  },
  methods: {
    getData() {
      axios
        .get("getData/" + this.surveyID)
        .then((response) => {
          // console.log(response.data)
          let data = [0, 0, 0, 0, 0];
          let res = response.data;

          this.respondents = res.customerCount;

          if (this.present === "all") {
            this.ratings = res.data.length;
            for (let i = 0; i < res.data.length; i++) {
              data[res.data[i].rating - 1]++;
            }
            this.initializeChart(data);
          } else if (this.present === "single") {
            this.ratings = res.customerCount;
            let trav = res.questionCount;

            for (
              let i = this.counter, j = 0;
              j < res.customerCount;
              i += trav, j++
            ) {
              data[res.data[i].rating - 1]++;
            }

            this.initializeChart(data);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getData();
  },
};
</script>

