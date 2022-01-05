import { createRouter, createWebHashHistory } from "vue-router";

import HomePage from "./pages/HomePage.vue";
import CustomerPage from "./pages/CustomerPage.vue";
import CompanyPage from "./pages/CompanyPage.vue";

const routes = [
    {
        path: "/",
        name: "HomePage",
        component: HomePage,
        meta: { guest: true },
    },
    {
        path: "/customer",
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
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

function loggedIn() {
    return localStorage.getItem("token");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: "/",
            });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guest)) {
        if (loggedIn()) {
          const name = localStorage.getItem("pathname");
            next({
                name: "company",
                params: { pathname: name},
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;
