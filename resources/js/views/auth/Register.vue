<template>
  <v-container class="fill-height">
    <v-row justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card elevation="8" class="pa-4" color="surface">
          <v-card-title class="text-h5 text-center">
            Sign Up
          </v-card-title>
          
          <v-card-text>
            <v-form @submit.prevent="handleRegister">
              <!-- Full Name Input -->
              <v-text-field
                v-model="form.name"
                label="Full Name"
                prepend-inner-icon="mdi-account"
                variant="outlined"
                class="mb-2"
                color="primary"
              ></v-text-field>

              <!-- Email Input -->
              <v-text-field
                v-model="form.email"
                label="Email Address"
                type="email"
                prepend-inner-icon="mdi-email"
                variant="outlined"
                class="mb-2"
                color="primary"
              ></v-text-field>

              <!-- Password Input -->
              <v-text-field
                v-model="form.password"
                label="Password"
                type="password"
                prepend-inner-icon="mdi-lock"
                variant="outlined"
                class="mb-2"
                color="primary"
              ></v-text-field>

              <!-- Password Confirmation Input (Important for Breeze) -->
              <v-text-field
                v-model="form.password_confirmation"
                label="Confirm Password"
                type="password"
                prepend-inner-icon="mdi-lock-check"
                variant="outlined"
                class="mb-2"
                color="primary"
              ></v-text-field>

              <v-btn
                type="submit"
                color="primary"
                block
                size="large"
                class="mt-4"
                variant="flat"
              >
                Create Account
              </v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
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
