<template>
  <div class="container">
    <div class="row d-flex d-flex align-items-center">
      <div class="col-auto mt-3" v-for="survey in surveys" :key="survey">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title pb-2 fw-bold">{{ survey.name }}</h4>
            <p class="card-subtitle text-muted border-top pt-2">
              Date Created: {{ $filters.formatDate(survey.created_at) }}
            </p>
            <p class="card-subtitle mb-3 text-muted border-bottom pb-2">
              Date Updated: {{ $filters.formatDate(survey.updated_at) }}
            </p>
            <div class="mt-3">
              <Delete
                myclass="btn btn-outline-danger btn-sm float-end"
                :surveyID="survey.surveyID"
                :modal="`modal${survey.surveyID}`"
                :routeNum="parseInt(0)"
              />
              <router-link
                :to="{
                  name: 'survey',
                  params: { pathname: survey.name },
                  query: {
                    surveyID: survey.surveyID,
                  },
                }"
                class="btn btn-outline-success btn-sm me-2 float-end"
                >View More</router-link
              >
            </div>
          </div>
        </div>
      </div>

      <div
        class="container empty border-bottom pb-4"
        v-if="surveys.length == 0"
      >
        <div class="row justify-content-center">
          <div class="col-md-12 text-center">
            <span class="display-6 text-danger d-block">Empty</span>
            <div class="mt-2">You have no survey created at the moment.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Delete from "./Delete.vue";

export default {
  name: "Card",
  components: {
    Delete,
  },
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
  font-size: 14px;
}
.card {
  width: 19.1rem;
  height: 11rem;
}
.empty {
  font-size: 16px;
  margin-top: 140px;
}
</style>
