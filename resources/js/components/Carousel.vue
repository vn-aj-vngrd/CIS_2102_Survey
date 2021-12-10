<template>
  <Carousel class="mycarousel shadow bg-body rounded">
    <Slide v-for="slide in 10" :key="slide">
      <div class="carousel__item">Question {{ slide }}</div>
    </Slide>

    <template #addons>
      <Navigation />
      <div class="emoji-container">
        <span class="emoji emoji--hearteyes"></span>
        <span class="emoji emoji--happy"></span>
        <span class="emoji emoji--neutral"></span>
        <span class="emoji emoji--frowning"></span>
        <span class="emoji emoji--disappointed"></span>
      </div>
    </template>
  </Carousel>
</template>

<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

export default {
  name: "App",
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
};
</script>

<style scoped>
.mycarousel {
  margin-top: 100px;
}

.carousel__item {
  min-height: 400px;
  width: 100%;
  background-color: white;
  color: black;
  font-size: 20px;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}


.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}

.emoji-container {
  background: white;
  padding-bottom: 20px;
  padding-top: 20px;
}

.emoji {
  padding: 1rem;
  font-size: 2rem;
  transform: scale(0.5);
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  transition: text-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
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