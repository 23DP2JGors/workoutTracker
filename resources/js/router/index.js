import { createRouter, createWebHistory } from 'vue-router'
import { user, fetchUser } from '@/stores/auth.js'
import Home from '../views/home.vue'
import Register from '../views/auth/Register.vue'
import Login from '../views/auth/Login.vue'
import Landing from '../views/Landing.vue'
import Workouts from '../views/Workouts.vue'
import MacrosCalc from '../views/MacrosCalc.vue'
import Measurements from '../views/Measurements.vue'


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
    { 
        path: '/workouts',
        name: 'Workouts',
        component: Workouts 
    },
    {
        path: '/macros',
        name: 'macros.calc',
        component: MacrosCalc
    },
    {
        path:'/measurements',
        name: 'Measurements',
        component: Measurements,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Navigation Guard
router.beforeEach(async (to, from, next) => {
    // Fetch current user status before each navigation
    await fetchUser()

    const isLoggedIn = !!user.value
    const isAuthPage = to.meta.layout === 'auth'
    const isLanding = to.meta.layout === 'none'

    if (isLoggedIn && (isAuthPage || isLanding)) {
        // Logged in user tries to access login/register/landing — redirect to home
        next({ name: 'Home' })
    } else if (!isLoggedIn && !isAuthPage && !isLanding) {
        // Guest tries to access protected page — redirect to landing
        next({ name: 'Landing' })
    } else {
        // All good — proceed
        next()
    }
})

export default router