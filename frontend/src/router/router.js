import { createRouter, createWebHistory } from "vue-router"

const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/',
            component: () => import('@/pages/dashboard/index.vue'),
            name: 'dashboard.index'
        },
        {
            path: '/register',
            component: () => import('@/pages/auth/register/index.vue'),
            name: 'auth.register.index'
        },
        {
            path: '/register/activity_level',
            component: () => import('@/pages/auth/register/activity_level.vue'),
            name: 'auth.register.activity_level'
        },
        {
            path: '/login',
            component: () => import('@/pages/auth/login/index.vue'),
            name: 'auth.login.index'
        },
        {
            path: '/nutrition',
            component: () => import('@/pages/nutrition/index.vue'),
            name: 'nutrition.index'
        },
        {
            path: '/products',
            component: () => import('@/pages/products/index.vue'),
            name: 'products.index'
        }
    ]
})

export default router