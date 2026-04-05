<template>
  <v-container>
    <v-row justify="center">
        <v-col cols="12" sm="8" md="6" lg="4">
            <v-sheet color="surface">
                <p class="text-center text-uppercase ">welcome to workout tracker!</p>
                <v-form fast-fail @submit.prevent="handleRegister">
                <v-text-field
                    v-model="form.username"
                    :rules="[rules.required]"
                    label="Username"
                ></v-text-field>

                <v-text-field
                    v-model="form.email"
                    :rules="[rules.required, rules.email]"
                    label="E-mail"
                ></v-text-field>

                <v-text-field
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"   
                    v-model="form.password"
                    :rules="[rules.required, rules.minLength,rules.hasLower, rules.hasSymbol, rules.hasUpper]"
                    label="Password"
                    @click:append-inner="visible = !visible"
                ></v-text-field>

                <v-text-field
                    v-model="form.password_confirmation"
                    :type="visible ? 'text' : 'password'"
                    :rules="[rules.required, confirmPassword]"
                    label="Password repeat"
                ></v-text-field>

                <v-btn class="mt-2" type="submit" block>Submit</v-btn>
                </v-form>
            </v-sheet>
        </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
'use strict';

// Import necessary Vue composables and libraries
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

// Initialize router for navigation
const router = useRouter();

// Define validation rules for form fields
const rules = {
    required: v => !!v || 'Field is required',
    email: v => /.+@.+\..+/.test(v) || 'Email is not correct',
    minLength: v => v.length >= 8 || 'at least 8 characters',
    hasUpper: v => /[A-Z]/.test(v) || 'Include an uppercase letter',
    hasLower: v => /[a-z]/.test(v) || 'Include an lowercase letter',
    hasSymbol: v => /[^a-zA-Z0-9]/.test(v) || 'Include special character',
};

// Reactive data for the registration form; .value is sent to the API as payload
const form = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
});

// Function to confirm password matches
const confirmPassword = v => v === form.value.password || 'Passwords does not match';

// Reactive state for password visibility toggle
const visible = ref(false);

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
    await axios.get('/sanctum/csrf-cookie');

    // 2. Send the registration request to Laravel endpoint
    const response = await axios.post('/register', form.value);

    // Debug: show server replies (e.g. user object, tokens)
    console.log('User registered:', response.data);

    // 3. On success, navigate to application home/dashboard
    await router.push('/');
  } catch (error) {
    // 4. Basic error reporting: log backend validation errors and show user notification
    console.error('Registration failed:', error.response?.data?.errors ?? error);
    alert('Registration failed. Please check your input and try again.');
  }
}
</script>