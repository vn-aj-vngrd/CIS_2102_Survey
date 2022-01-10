<template>
  <Carousel class="shadow bg-body rounded border border-muted">
    <Slide v-for="(question, index) in questions" :key="index">
      <div class="carousel__item">
        <div class="title-container">{{ surveyName }}</div>
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
            <span class="emoji emoji--hearteyes"
              ><p class="text-muted">Very Satisfied</p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--happy"
              ><p class="text-muted">Satisfied</p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--neutral"
              ><p class="text-muted">Neutral</p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--frowning"
              ><p class="text-muted">Unsatisfied</p></span
            >
          </div>
          <div class="col">
            <span class="emoji emoji--disappointed"
              ><p class="text-muted">Very Unsatisfied</p></span
            >
          </div>
        </div>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
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
        responses: [],
      },
      questions: [],
      surveyName: "",
    };
  },
  methods: {
    getQuestions() {
      axios
        .get("getQuestions/" + localStorage.getItem("surveyID"))
        .then((response) => {
          this.questions = response.data;
          // console.log(response.data);
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
    this.getQuestions();
  },
};
</script>

<style scoped>
.title-container {
  margin-bottom: 11rem;
}

.carousel__item {
  min-height: 300px;
  margin-top: 1.5rem;
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
  margin-bottom: 1.5rem;
  padding-top: 10px;
  max-width: 100%;
}

.emoji {
  font-size: 1.3rem;
  transform: scale(0.5);
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  transition: text-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
}

.emoji p {
  font-size: 14px;
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
</style>