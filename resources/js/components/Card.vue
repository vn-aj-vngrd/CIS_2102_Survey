<template>
  <div class="container">
    <div class="row d-flex d-flex align-items-center">
      <div class="col-auto mb-5" v-for="survey in surveys" :key="survey">
        <div class="card shadow-sm" style="width: 19.1rem">
          <div class="card-body">
            <h5 class="card-title"><b>Title: </b>{{ survey.name }}</h5>
            <p class="card-subtitle mb-3 text-muted border-bottom pb-2">
              <b>Date Created:</b> {{ $filters.formatDate(survey.created_at) }}
            </p>
            <a class="btn btn-danger btn-sm float-end">Delete</a>
            <a class="btn btn-success btn-sm me-2 float-end">View More</a>
          </div>
        </div>
      </div>
      <h6 class="text-danger text-center mb-4 mt-2" v-if="surveys.length == 0">
        You currently have no created surveys.
      </h6>
    </div>
  </div>
</template>

<script>

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

<style scoped>
p {
  font-size: 13px;
}
</style>
