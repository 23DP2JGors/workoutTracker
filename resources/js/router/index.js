import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/home.vue'
import Register from '../views/auth/Register.vue'
import Login from '../views/auth/Login.vue'
import Landing from '../views/Landing.vue'

const routes = [
    {
        path: '/home',          
        name: 'Home',
        component: Home
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: { layout: 'auth' }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: { layout: 'auth' }
    },
    {
        path: '/',
        name:'Landing',
        component: Landing,
        meta: { layout: 'none' }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router