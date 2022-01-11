<template>
  <!-- {{ questions }}
  <br />
  {{ formData.ratings }}
  <br />
  {{ formData.questions }} -->

  <Carousel class="my-carousel shadow bg-body rounded border border-muted">
    <Slide
      class="my-carousel"
      v-for="(question, index) in questions"
      :key="index"
    >
      <div class="carousel__item">
        <div class="title-container fw-bold text-muted">{{ surveyName }}</div>
        <span class="text-muted"> Question {{ index + 1 }} <b>| </b></span>
        <b>{{ question.text }}</b>

        <div
          class="
            row
            emoji-container
            shadow
            bg-body
            rounded-pill
            border border-muted
          "
        >
          <div class="col">
            <span class="emoji emoji--disappointed" @click="rate(1, index)"
              ><p :class="formData.ratings[index] == 1 ? selected : ''">
                Very Unsatisfied
              </p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--frowning" @click="rate(2, index)"
              ><p :class="formData.ratings[index] == 2 ? selected : ''">
                Unsatisfied
              </p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--neutral" @click="rate(3, index)"
              ><p :class="formData.ratings[index] == 3 ? selected : ''">
                Neutral
              </p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--happy" @click="rate(4, index)"
              ><p :class="formData.ratings[index] == 4 ? selected : ''">
                Satisfied
              </p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--hearteyes" @click="rate(5, index)"
              ><p :class="formData.ratings[index] == 5 ? selected : ''">
                Very Satisfied
              </p></span
            >
          </div>
        </div>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>

  <div class="d-flex justify-content-center mt-5">
    <button
      type="button"
      :class="
        count < formData.questions.length
          ? 'btn btn-success disabled'
          : 'btn btn-success'
      "
      data-bs-toggle="modal"
      data-bs-target="#finish"
    >
      Submit Survey
    </button>
  </div>
  <p class="d-flex justify-content-center text-muted text-center mt-4">
    To submit the survey, please answer all the survey questions.
  </p>

  <div
    class="modal fade text-start"
    id="finish"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Survey</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          Are you sure you want to submit the survey?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Cancel
          </button>
          <button @click="submitSurvey" class="btn btn-primary">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

export default {
  name: "Question",
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  setup() {
    return {
      // carousel settings
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 1,
          snapAlign: "center",
        },
        // 1024 and up
        1024: {
          itemsToShow: 1,
          snapAlign: "start",
        },
      },
    };
  },
  data() {
    return {
      formData: {
        ratings: [],
        questions: [],
        responseSetID: 0,
      },
      count: 0,
      questions: [],
      surveyName: "",
      selected: "text-primary fw-bold",
    };
  },
  methods: {
    getQuestions() {
      axios
        .get("getQuestions/" + localStorage.getItem("surveyID"))
        .then((response) => {
          this.questions = response.data;
          for (let i = 0; i < this.questions.length; i++) {
            this.formData.ratings.push(0);
            this.formData.questions.push(this.questions[i].questionID);
          }
          // console.log(response.data);
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    rate(rating, index) {
      // console.log(rating);
      // console.log(index);

      this.formData.ratings[index] = rating;
      if (index == this.count) this.count++;
    },
    submitSurvey() {
      // console.log(this.formData);
      axios
        .post("submitSurvey", this.formData)
        .then((response) => {
          // console.log(response);
          localStorage.removeItem("token");
          localStorage.removeItem("responseSetID");
          localStorage.removeItem("pathname");
          localStorage.removeItem("surveyName");
          localStorage.removeItem("surveyID");
          localStorage.removeItem("tokenType");

          this.$router.push("/");
          $("#finish").modal("hide");
          this.$toast.success(`Survey Successfully Submitted`, {
            position: "top",
            queue: true,
          });
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  created() {
    // console.log(localStorage.getItem("surveyID"));
    // console.log(localStorage.getItem("responseSetID"));
    this.surveyName = localStorage.getItem("surveyName");
    this.formData.responseSetID = localStorage.getItem("responseSetID");
    this.getQuestions();
  },
};
</script>

<style scoped>
.modal.in .modal-dialog {
  -webkit-transform: none;
  -ms-transform: none;
  transform: none;
}
.title-container {
  margin-bottom: 9rem;
  font-size: 16px;
}

.my-carousel {
  background: white;
}
.carousel__item {
  min-height: 300px;
  margin-top: 2rem;
  width: 90%;
  background-color: white;
  color: black;
  font-size: 20px;
  display: block;
  justify-content: center;
  align-items: center;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}

.emoji-container {
  margin-top: 9rem;
  margin-bottom: 2rem;
  padding-top: 10px;
  max-width: 100%;
}

.emoji {
  font-size: 1.3rem;
  transform: scale(0.5);
  text-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
  transition: text-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
}

p {
  font-size: 14px;
  color: #777;
}

.emoji-selected {
  color: #0d6efd;
  font-weight: bold;
}

.emoji:hover {
  transform: scale(1) translatey(-20px);
  text-shadow: 0 20px 20px rgba(0, 0, 0, 0.3);
}

.emoji--hearteyes:before {
  content: "😍";
}

.emoji--happy:before {
  content: "🙂";
}

.emoji--neutral:before {
  content: "😐";
}

.emoji--frowning:before {
  content: "🙁";
}

.emoji--disappointed:before {
  content: "😞";
}

.modal-body {
  font-size: 17px;
}
</style>