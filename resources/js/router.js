import { createRouter, createWebHistory } from "vue-router"
import axios from 'axios'

const routes = [
    {
        path: '/sign-in',
        component: () => import('./components/SignIn.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if(to.path === '/') {
        next('/sign-in') //To change it later
    } else {
        next();
    }
})
