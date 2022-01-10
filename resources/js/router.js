import { createRouter, createWebHashHistory } from "vue-router";

import HomePage from "./pages/HomePage.vue";
import CustomerPage from "./pages/CustomerPage.vue";
import CompanyPage from "./pages/CompanyPage.vue";
import SurveyPage from "./pages/SurveyPage.vue";
import PageNotFound from "./pages/PageNotFound.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: HomePage,
        meta: { guest: true },
    },
    {
        path: "/customer/:pathname",
        name: "customer",
        component: CustomerPage,
        meta: { requiresAuth: true },
    },
    {
        path: "/company/:pathname",
        name: "company",
        component: CompanyPage,
        meta: { requiresAuth: true },
    },
    {
        path: "/company/survey/:pathname",
        name: "survey",
        component: SurveyPage,
        meta: { requiresAuth: true },
    },
    { path: "/:NotFound(.*)*", component: PageNotFound },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

function loggedIn() {
    return localStorage.getItem("token");
}

router.beforeEach((to, from, next) => {
    let modalBackground = document.querySelector(".modal-backdrop");
    if (modalBackground) {
        modalBackground.remove();
    }
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!loggedIn()) {
            next({
                path: "/",
            });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guest)) {
        if (loggedIn()) {
            if (localStorage.getItem("tokenType") == "company") {
                const name = localStorage.getItem("pathname");
                next({
                    name: "company",
                    params: { pathname: name },
                });
            } else if (localStorage.getItem("tokenType") == "customer") {
                const name = localStorage.getItem("pathname");
                next({
                    name: "customer",
                    params: { pathname: name },
                });
            }
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
