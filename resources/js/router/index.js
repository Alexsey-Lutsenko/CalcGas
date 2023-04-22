import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "login.page",
        component: () => import("../components/App.vue"),
    }
];

const router = createRouter({
    routes,
    history: createWebHistory(),
    linkActiveClass: "active",
    linkExactActiveClass: "active",
});

router.beforeEach(async (to, from, next) => {

    next();
});

export default router;
