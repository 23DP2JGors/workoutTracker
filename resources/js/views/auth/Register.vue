<template>
  <v-container>
    <v-row justify="center">
        <v-col cols="12" sm="10" md="8" lg="5">
            <v-sheet color="surface" rounded="lg">
                <p class="title-h1 px-6 pt-5 text-center">
                    {{ $t('register.title') }}
                </p>
                <p class="text-center font-weight-thin" color="subheading">
                    {{ $t('register.subtitle') }}
                </p>
                <v-form ref="formRef" fast-fail @submit.prevent="handleRegister" class="pa-6">
                <v-text-field class="mb-3"
                    v-model="form.username"
                    type="text"
                    maxlength="50"
                    :rules="[rules.required]"
                    :label="$t('register.username')"
                ></v-text-field>

                <v-text-field class="mb-3"
                    v-model="form.email"
                    :rules="[rules.required, rules.email]"
                    :label="$t('register.email')"
                    :placeholder="$t('register.emailPlaceholder')"
                ></v-text-field>

                <v-text-field class="mb-3"
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"   
                    v-model="form.password"
                    :rules="[rules.required, rules.minLength,rules.hasLower, rules.hasSymbol, rules.hasUpper]"
                    :label="$t('register.password')"
                    @click:append-inner="visible = !visible"
                ></v-text-field>

                <v-text-field
                    v-model="form.password_confirmation"
                    :type="visible ? 'text' : 'password'"
                    :rules="[rules.required, confirmPassword]"
                    :label="$t('register.passwordRepeat')"
                ></v-text-field>

                <v-checkbox
                    v-model="checkbox"
                    :rules="[rules.agree]"                    
                    indent-details
                >
                    <template #label>
                        <div>
                            {{ $t('register.agreeText') }}
                            <a href="#" @click.stop class="text-decoration-none">
                                {{ $t('register.terms') }}
                            </a>
                            {{ $t('register.and') }}
                            <a href="#" @click.stop class="text-decoration-none">
                                {{ $t('register.privacy') }}
                            </a>
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
                    {{ $t('register.registrationFailed') }}
                </v-alert>
                <v-btn class="mt-2" type="submit" block>
                    {{ $t('register.submit') }}
                </v-btn>

                <div class="text-center mt-4">
                    {{ $t('register.alreadyHaveAccount') }}
                    <router-link to="/login">{{ $t('register.login') }}</router-link>
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
import { useI18n } from 'vue-i18n';


// Initialize router for navigation
const router = useRouter();
const shake = ref(false);
const errorMessage = ref('');
const formRef = ref(null)

// Provides translated validation and error messages
const { t } = useI18n()

// Reactive data for the registration form; .value is sent to the API as payload
const form = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
});

// checkbox
const checkbox = ref(false);

// Checks that repeated password matches the original password
const confirmPassword = v => v === form.value.password || t('register.passwordsDoNotMatch')

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
        errorMessage.value = t('register.fixFormErrors')
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
        errorMessage.value = error.response?.data?.message || t('register.tryAgain')
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