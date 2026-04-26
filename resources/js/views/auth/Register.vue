<template>
  <v-container>
    <v-row justify="center">
        <v-col cols="12" sm="10" md="8" lg="5">
            <v-sheet color="surface" rounded="lg">
                <p class="title-h1 px-6 pt-5 text-center">welcome to workout tracker!</p>
                <p class="text-center font-weight-thin" color="subheading">Create your account</p>
                <v-form ref="formRef" fast-fail @submit.prevent="handleRegister" class="pa-6">
                <v-text-field class="mb-3"
                    v-model="form.username"
                    :rules="[rules.required]"
                    label="Username"
                ></v-text-field>

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

                <v-checkbox
                    v-model="checkbox"
                    :rules="[rules.agree]"                    
                    indent-details
                >
                    <template #label>
                        <div>
                            I agree to the 
                            <a href="#" @click.stop class="text-decoration-none">Teams & Conditions</a>
                            and
                            <a href="#" @click.stop class="text-decoration-none">Privacy Policy</a>
                        </div>
                    </template>
                </v-checkbox>
            <v-alert 
                    v-if="errorMessage" 
                    type="error"
                    variant="tonal"
                    density="compact"
                    rounded="lg"
                    class="mb-3"
                    :class="{ 'shake': shake }"
                >
                    Registration failed. Please try again.
                </v-alert>
                <v-btn class="mt-2" type="submit" block>Submit</v-btn>

                <div class="text-center mt-4">
                    Already have an account?
                    <router-link to="/login">Log in</router-link>
                </div>
                </v-form>
            </v-sheet>
        </v-col>
    </v-row>
  </v-container>
</template>

<script setup>

// Import necessary Vue composables and libraries
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { rules } from '@/utils/rules.js';

// Initialize router for navigation
const router = useRouter();
const shake = ref(false);
const errorMessage = ref('');
const formRef = ref(null)

// Reactive data for the registration form; .value is sent to the API as payload
const form = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
});

// checkbox
const checkbox = ref(false);

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
    // Validate form before sending
    const { valid } = await formRef.value.validate()
    if (!valid) {
        errorMessage.value = 'Please correct the errors in the form.';
        shake.value = true;
        setTimeout(() => shake.value = false, 500);
        return;
    }

    try {
        // 1. Ensure frontend has valid CSRF token cookie for the session
        await axios.get('/sanctum/csrf-cookie');

        // 2. Send the registration request to Laravel endpoint
        const response = await axios.post('/register', form.value);

        // Debug: show server replies (e.g. user object, tokens)
        console.log('User registered:', response.data);

        // 3. On success, navigate to application home/dashboard
        if (response.status === 204 || response.status === 201) {
        await router.push('/home');
    }
    } catch (error) {
        errorMessage.value = error.response?.data?.message || 'Registration failed. Try again.';
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