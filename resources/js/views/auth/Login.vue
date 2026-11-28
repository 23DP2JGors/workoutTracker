<template>
  <AuthLayout variant="login">
    <section class="login-card" :aria-labelledby="formTitleId">
      <p class="login-eyebrow">{{ $t('login.eyebrow') }}</p>
      <h1 :id="formTitleId">{{ $t('login.title') }}</h1>
      <p class="login-subtitle">{{ $t('login.subtitle') }}</p>

      <v-form
        ref="formRef"
        class="login-form"
        fast-fail
        @submit.prevent="handleLogin"
      >
        <v-alert
          v-if="errorMessage"
          class="auth-error"
          type="error"
          variant="tonal"
          density="compact"
          rounded="lg"
          :class="{ shake }"
        >
          {{ errorMessage }}
        </v-alert>

        <v-text-field
          v-model="form.email"
          class="auth-field"
          type="email"
          autocomplete="username"
          :rules="[validationRules.required, validationRules.email]"
          :label="$t('login.email')"
          hide-details="auto"
        />

        <v-text-field
          v-model="form.password"
          class="auth-field"
          autocomplete="current-password"
          :type="visible ? 'text' : 'password'"
          :rules="[validationRules.required]"
          :label="$t('login.password')"
          hide-details="auto"
        >
          <template #append-inner>
            <button
              class="password-visibility"
              type="button"
              :aria-label="$t(visible ? 'auth.hidePassword' : 'auth.showPassword')"
              @click.stop="visible = !visible"
            >
              <v-icon :icon="visible ? 'mdi-eye-off' : 'mdi-eye'" />
            </button>
          </template>
        </v-text-field>

        <v-btn
          class="login-submit"
          type="submit"
          color="primary"
          size="large"
          block
          :loading="loading"
          :disabled="loading"
          :class="{ shake }"
        >
          {{ $t('login.submit') }}
        </v-btn>
      </v-form>

      <p class="auth-switch">
        {{ $t('login.noAccount') }}
        <router-link to="/register">{{ $t('login.register') }}</router-link>
      </p>
    </section>
  </AuthLayout>
</template>

<script setup>
import { onBeforeUnmount, ref, watch } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import AuthLayout from '@/components/auth/AuthLayout.vue'
import { createAuthRules } from '@/utils/rules.js'

const router = useRouter()
const { t, locale } = useI18n()
const validationRules = createAuthRules(t)
const formTitleId = 'login-form-title'
const formRef = ref(null)
const visible = ref(false)
const shake = ref(false)
const errorMessage = ref('')
const loading = ref(false)
let shakeTimer

const form = ref({
  email: '',
  password: '',
})

const triggerShake = () => {
  shake.value = false
  clearTimeout(shakeTimer)
  requestAnimationFrame(() => {
    shake.value = true
    shakeTimer = setTimeout(() => {
      shake.value = false
    }, 500)
  })
}

watch(locale, () => {
  formRef.value?.resetValidation()
})

onBeforeUnmount(() => clearTimeout(shakeTimer))

const handleLogin = async () => {
  errorMessage.value = ''
  const { valid } = await formRef.value.validate()
  if (!valid) {
    triggerShake()
    return
  }

  loading.value = true
  try {
    await axios.get('/sanctum/csrf-cookie')
    const response = await axios.post('/login', form.value)
    console.log('User registered:', response.data)
    await router.push('/home')
  } catch (error) {
    errorMessage.value = error.response?.data?.message || t('login.tryAgain')
    triggerShake()
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-card {
    box-sizing: border-box;
    width: min(100%, 420px);
    padding: 32px;
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 12%, transparent);
    border-radius: 16px;
    background: rgb(var(--v-theme-surface));
    box-shadow: 0 24px 64px color-mix(in srgb, rgb(var(--v-theme-primary)) 14%, transparent);
}

.login-eyebrow {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 10px;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.6875rem;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.login-eyebrow::before {
    width: 16px;
    height: 4px;
    background: rgb(var(--v-theme-secondary));
    content: '';
    transform: skewX(-24deg);
}

.login-card h1 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 800;
    line-height: 1.15;
}

.login-subtitle {
    margin: 6px 0 18px;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.9375rem;
    line-height: 1.4;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.auth-error {
    margin: 0;
}

.password-visibility {
    display: grid;
    place-items: center;
    padding: 0;
    border: 0;
    border-radius: 4px;
    color: rgb(var(--v-theme-subheading));
    background: transparent;
    cursor: pointer;
}

.password-visibility:focus-visible {
    outline: 2px solid rgb(var(--v-theme-primary));
    outline-offset: 2px;
}

.login-submit {
    margin-top: 2px;
    text-transform: none;
    font-weight: 800;
}

.auth-switch {
    margin: 16px 0 0;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.8125rem;
    text-align: center;
}

.auth-switch a {
    color: rgb(var(--v-theme-primary));
    font-weight: 700;
    text-decoration: none;
}

.auth-switch a:focus-visible {
    border-radius: 2px;
    outline: 2px solid rgb(var(--v-theme-primary));
    outline-offset: 3px;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-6px); }
    40%, 80% { transform: translateX(6px); }
}

.shake {
    animation: shake 0.5s ease;
}

@media (max-width: 600px) {
    .login-card {
        padding: 24px;
    }
}

@media (max-height: 720px) {
    .login-card {
        padding: 20px;
    }

    .login-subtitle {
        margin-bottom: 12px;
    }

    .login-form {
        gap: 8px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .shake {
        animation: none;
    }
}
</style>
