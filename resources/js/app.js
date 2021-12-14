import { createApp } from 'vue';
require('./bootstrap');

let app=createApp({})
app.component('landing-component', require('./components/Landing.vue').default);
app.component('header-component', require('./components/Header.vue').default);
app.component('footer-component', require('./components/Footer.vue').default);
app.component('carousel-component', require('./components/Carousel.vue').default);
app.component('create-component', require('./components/Create.vue').default);
app.component('display-component', require('./components/Display.vue').default);

app.mount("#app")

