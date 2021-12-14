require('./bootstrap');

// import {createApp} from 'vue';
// import App from './App.vue';
// import router from './router'

// createApp(App).use(router).mount('#app');
import { createApp } from 'vue';
require('./bootstrap');

let app=createApp({})
app.component('landing-component', require('./components/Landing.vue').default);
app.component('header-component', require('./components/Header.vue').default);
app.component('footer-component', require('./components/Footer.vue').default);
app.component('carousel-component', require('./components/Carousel.vue').default);



app.mount("#app")

