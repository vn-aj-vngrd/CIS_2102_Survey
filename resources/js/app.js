require("./bootstrap");

import { createApp } from "vue";
import App from "./App.vue";
import Router from "./router";
import moment from "moment";
import Toaster from "@meforma/vue-toaster";
const app = createApp(App);

app.use(Router);
app.use(Toaster);
app.mount("#app");
app.config.globalProperties.$filters = {
    formatDate(value) {
        if (value) {
            return moment(String(value)).format("MM/DD/YYYY, h:mm:ss a");
        }
    },
};
