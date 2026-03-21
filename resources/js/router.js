import { createRouter, createWebHistory } from "vue-router"

const routes = [
    {
        path: '/',
        component: () => import('./components/SignIn.vue'),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})
