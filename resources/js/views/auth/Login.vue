<template>
<v-container>
    <v-row justify="center">
        <v-col cols="12" sm="10" md="8" lg="5">
            <v-sheet color="surface" rounded="lg">
                <p class="title-h1 px-6 pt-5 text-center">welcome back!</p>
                <v-form fast-fail @submit.prevent="handleLogin" class="pa-6">

                <v-text-field class="mb-3"
                    v-model="form.email"
                    :rules="[rules.required, rules.email]"
                    label="E-mail"
                    placeholder="email@example.com"
                ></v-text-field>

                <v-text-field class="mb-3"
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"   
                    v-model="form.password"
                    :rules="[rules.required]"
                    label="Password"
                    @click:append-inner="visible = !visible"
                ></v-text-field>

                <v-alert 
                    v-if="errorMessage" 
                    type="error"
                    variant="tonal"
                    density="compact"
                    rounded="lg"
                    class="mb-3"
                    :class="{ shake: shake }"
                >
                    Invalid email or password. Please try again.
                </v-alert>

                <v-btn class="mt-2" type="submit" block>Login</v-btn>

                <div class="text-center mt-4">
                    Don't have an account?
                    <router-link to="/register">Sign in</router-link>
                </div>
                </v-form>
            </v-sheet>
        </v-col>
    </v-row>
  </v-container>
</template>

<script setup>

import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { rules } from '@/utils/rules.js';

// Initialize router for navigation
const router = useRouter();

// Reactive data for the registration form; .value is sent to the API as payload
const form = ref({
  email: '',
  password: '',
});

// Reactive state for password visibility toggle
const visible = ref(false);
const shake = ref(false)
const errorMessage = ref(null);

const handleLogin = async () => {
  try {

  // 1. Ensure frontend has valid CSRF token cookie for the session
    await axios.get('/sanctum/csrf-cookie');

    // 2. Send the login request to Laravel endpoint
    const response = await axios.post('/login', form.value);

    // Debug: show server replies (e.g. user object, tokens)
    console.log('User registered:', response.data);

    // 3. On success, navigate to application home/dashboard
    await router.push('/home');
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Login failed. Try again.';
    // Trigger shake animation
    shake.value = true
    setTimeout(() => shake.value = false, 500)
}
}
</script>

<style scoped>
/* Shake animation when login fails repeatedly */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20% { transform: translateX(-10px); }
    40% { transform: translateX(10px); }
    60% { transform: translateX(-10px); }
    80% { transform: translateX(10px); }
}

.shake {
    animation: shake 0.5s ease;
}
</style>