require("./bootstrap");

import { createApp } from "vue";
import App from "./App.vue";
import Router from "./router";
import Toaster from '@meforma/vue-toaster';
createApp(App).use(Router).use(Toaster).mount("#app");

// let app=createApp({})
// app.component('landing-component', require('./components/Landing.vue').default);
// app.component('header-component', require('./components/Header.vue').default);
// app.component('footer-component', require('./components/Footer.vue').default);
// app.component('carousel-component', require('./components/Carousel.vue').default);
// app.component('create-component', require('./components/Create.vue').default);
// app.component('display-component', require('./components/Display.vue').default);
// app.component('homepage', require('./pages/HomePage.vue').default);
// app.mount("#app")
// app.use(router)