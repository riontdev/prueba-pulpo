import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/app/login',
            component: () => import('./pages/Login.vue')
        },
        {
            path: '/app/home',
            component: () => import('./pages/Home.vue')
        }
    ],
})
router.beforeEach((to, from, next) => {
    if (to.path !== '/app/home' && to.path !== '/app/login' && !isAuthenticated()) {
        return next({path: '/'})
    }
    return next()
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('API_TOKEN'))
}

export default router;