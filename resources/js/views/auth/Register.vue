<template>
  
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

// Reactive data for the registration form; .value is sent to the API as payload
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

/**
 * Handle form submission and send data to Laravel Breeze via API.
 * Steps:
 *   1) CSRF protection 
 *   2) POST /register
 *   3) Redirect on success
 */
const handleRegister = async () => {
  try {
    // 1. Ensure frontend has valid CSRF token cookie for the session
    await axios.get('/sanctum/csrf-cookie')

    // 2. Send the registration request to Laravel endpoint
    const response = await axios.post('/register', form.value)

    // Debug: show server replies (e.g. user object, tokens)
    console.log('User registered:', response.data)

    // 3. On success, navigate to application home/dashboard
    await router.push('/')
  } catch (error) {
    // 4. Basic error reporting: log backend validation errors and show user notification
    console.error('Registration failed:', error.response?.data?.errors ?? error)
    alert('Registration failed. Please check your input and try again.')
  }
}
</script>
