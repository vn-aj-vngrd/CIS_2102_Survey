<template>
  <div class="container">
    <div class="row d-flex d-flex align-items-center">
      <div class="col-auto mb-5" v-for="survey in surveys" :key="survey">
        <div class="card shadow-sm" style="width: 19.1rem">
          <div class="card-body">
            <h5 class="card-title">{{ survey.name }}</h5>
            <h6 class="card-subtitle mb-3 text-muted">
              {{ $filters.formatDate(survey.created_at) }}
            </h6>

            <a class="btn btn-danger btn-sm float-end">Delete</a>
            <a class="btn btn-primary btn-sm me-2 float-end">View More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  name: "Card",
  data() {
    return {
      surveys: {},
    };
  },
  methods: {
    getSurveys() {
      axios
        .get("index")
        .then((response) => {
          this.surveys = response.data;
          // console.log(response.data);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  mounted() {
    this.getSurveys();
  },
};
</script>
