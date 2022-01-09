<template>
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="d-flex form-group">
        <input
          type="text"
          class="form-control"
          v-model="search"
          placeholder="Search Title..."
        />
      </div>
    </div>
    <div class="row d-flex d-flex align-items-center">
      <div class="col-auto mt-4" v-for="survey in filteredList" :key="survey">
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

      <div class="container empty" v-if="surveys.length == 0">
        <div class="mt-4 text-center text-danger">
          You have no created survey at the moment.
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
      surveys: [],
      search: "",
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
  computed: {
    filteredList() {
      return this.surveys.filter((val) => {
        return val.name.toLowerCase().includes(this.search.toLowerCase());
      });
    },
  },
  created() {
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
</style>
