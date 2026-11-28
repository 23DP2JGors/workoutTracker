<template>
  <AuthLayout variant="register">
    <section class="signup-card" :aria-label="$t('register.title')">
      <aside class="signup-promo">
        <div class="signup-promo-copy">
          <p class="auth-eyebrow">{{ $t('register.promoEyebrow') }}</p>
          <h1 class="signup-promo-title">{{ $t('register.promoTitle') }}</h1>
          <p class="signup-promo-description">{{ $t('register.promoDescription') }}</p>
        </div>

        <div
          class="signup-chart"
          role="img"
          :aria-label="$t('register.chartLabel')"
        >
          <div class="signup-chart-meta">
            <span>{{ $t('register.weeklyVolume') }}</span>
            <span>{{ $t('register.sampleData') }}</span>
          </div>
          <div class="signup-chart-columns">
            <div v-for="day in chartDays" :key="day.label" class="signup-chart-column">
              <div class="signup-chart-bar-track">
                <span
                  class="signup-chart-bar"
                  :class="{ 'signup-chart-bar--best': day.best }"
                  :style="{ '--bar-height': `${day.height}%` }"
                  aria-hidden="true"
                />
              </div>
              <span class="signup-chart-day">{{ $t(day.label) }}</span>
            </div>
          </div>
        </div>
      </aside>

      <section class="signup-form-panel" :aria-labelledby="formTitleId">
        <header class="signup-form-heading">
          <h2 :id="formTitleId">{{ $t('register.subtitle') }}</h2>
          <p>{{ $t('register.title') }}</p>
        </header>

        <v-form
          ref="formRef"
          class="signup-form"
          fast-fail
          @submit.prevent="handleRegister"
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
            v-model="form.username"
            class="auth-field"
            type="text"
            maxlength="50"
            autocomplete="username"
            :rules="[validationRules.required]"
            :label="$t('register.username')"
            hide-details="auto"
          />

          <v-text-field
            v-model="form.email"
            class="auth-field"
            type="email"
            autocomplete="email"
            :rules="[validationRules.required, validationRules.email]"
            :label="$t('register.email')"
            hide-details="auto"
          />

          <div class="signup-passwords">
            <v-text-field
              v-model="form.password"
              class="auth-field"
              autocomplete="new-password"
              :type="visible ? 'text' : 'password'"
              :rules="[
                validationRules.required,
                validationRules.minLength,
                validationRules.hasLower,
                validationRules.hasSymbol,
                validationRules.hasUpper,
                validationRules.hasNumber,
              ]"
              :label="$t('register.password')"
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

            <v-text-field
              v-model="form.password_confirmation"
              class="auth-field"
              autocomplete="new-password"
              :type="visible ? 'text' : 'password'"
              :rules="[validationRules.required, confirmPassword]"
              :label="$t('register.passwordRepeat')"
              hide-details="auto"
            />
          </div>

          <v-checkbox
            v-model="checkbox"
            class="signup-terms"
            density="compact"
            hide-details="auto"
            :rules="[validationRules.agree]"
          >
            <template #label>
              <i18n-t keypath="register.termsStatement" scope="global" tag="span">
                <template #terms>
                  <a href="#" @click.prevent.stop>{{ $t('register.terms') }}</a>
                </template>
                <template #privacy>
                  <a href="#" @click.prevent.stop>{{ $t('register.privacy') }}</a>
                </template>
              </i18n-t>
            </template>
          </v-checkbox>

          <v-btn
            class="signup-submit"
            type="submit"
            color="primary"
            size="large"
            block
            :loading="loading"
            :disabled="loading"
            :class="{ shake }"
          >
            {{ $t('register.submit') }}
          </v-btn>

          <p class="auth-switch">
            {{ $t('register.alreadyHaveAccount') }}
            <router-link to="/login">{{ $t('register.login') }}</router-link>
          </p>
        </v-form>
      </section>
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
const formTitleId = 'signup-form-title'
const formRef = ref(null)
const shake = ref(false)
const errorMessage = ref('')
const loading = ref(false)
const visible = ref(false)
const checkbox = ref(false)
let shakeTimer

const form = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const chartDays = [
  { label: 'register.chartDays.mon', height: 58 },
  { label: 'register.chartDays.tue', height: 43 },
  { label: 'register.chartDays.wed', height: 72 },
  { label: 'register.chartDays.thu', height: 50 },
  { label: 'register.chartDays.fri', height: 100, best: true },
  { label: 'register.chartDays.sat', height: 62 },
  { label: 'register.chartDays.sun', height: 38 },
]

const confirmPassword = value =>
  value === form.value.password || t('register.passwordsDoNotMatch')

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

const handleRegister = async () => {
  errorMessage.value = ''
  const { valid } = await formRef.value.validate()
  if (!valid) {
    triggerShake()
    return
  }

  loading.value = true
  try {
    await axios.get('/sanctum/csrf-cookie')
    const response = await axios.post('/register', form.value)
    console.log('User registered:', response.data)

    if (response.status === 204 || response.status === 201) {
      await router.push('/home')
    }
  } catch (error) {
    errorMessage.value = error.response?.data?.message || t('register.tryAgain')
    triggerShake()
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.signup-card {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    width: min(100%, 960px);
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 12%, transparent);
    border-radius: 16px;
    background: rgb(var(--v-theme-surface));
    box-shadow: 0 24px 64px color-mix(in srgb, rgb(var(--v-theme-primary)) 14%, transparent);
}

.signup-promo {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 32px;
    min-width: 0;
    padding: 32px 28px;
    border-right: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 12%, transparent);
    border-radius: 15px 0 0 15px;
    background: rgb(var(--v-theme-surface-bright));
}

.auth-eyebrow {
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

.auth-eyebrow::before {
    width: 16px;
    height: 4px;
    background: rgb(var(--v-theme-secondary));
    content: '';
    transform: skewX(-24deg);
}

.signup-promo-title {
    max-width: 380px;
    margin: 0;
    font-size: 2.25rem;
    font-weight: 800;
    line-height: 1.1;
}

.signup-promo-description {
    margin: 8px 0 0;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.9375rem;
    line-height: 1.45;
}

.signup-chart {
    box-sizing: border-box;
    height: 112px;
    padding: 12px;
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 10%, transparent);
    border-radius: 12px;
    background: rgb(var(--v-theme-surface));
}

.signup-chart-meta {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.625rem;
    line-height: 1;
}

.signup-chart-columns {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 6px;
    height: calc(100% - 18px);
    padding-top: 8px;
}

.signup-chart-column {
    display: grid;
    grid-template-rows: minmax(0, 1fr) auto;
    gap: 4px;
    min-width: 0;
}

.signup-chart-bar-track {
    display: flex;
    align-items: flex-end;
    min-height: 0;
}

.signup-chart-bar {
    display: block;
    width: 100%;
    height: var(--bar-height);
    border-radius: 4px 4px 2px 2px;
    background: color-mix(in srgb, rgb(var(--v-theme-primary)) 65%, transparent);
}

.signup-chart-bar--best {
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 35%, transparent);
    background: rgb(var(--v-theme-secondary));
}

.signup-chart-day {
    overflow: hidden;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.5625rem;
    line-height: 1;
    text-align: center;
    text-overflow: ellipsis;
}

.signup-form-panel {
    min-width: 0;
    padding: 28px;
}

.signup-form-heading {
    margin-bottom: 16px;
}

.signup-form-heading h2 {
    margin: 0;
    font-size: 1.625rem;
    font-weight: 800;
    line-height: 1.2;
}

.signup-form-heading p {
    margin: 4px 0 0;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.9375rem;
    line-height: 1.35;
}

.signup-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.auth-error {
    margin: 0;
}

.auth-field {
    min-width: 0;
}

.signup-passwords {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
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

.signup-terms {
    margin: 0;
}

.signup-terms :deep(.v-label) {
    opacity: 1;
    font-size: 0.8rem;
}

.signup-terms a,
.auth-switch a {
    color: rgb(var(--v-theme-primary));
    font-weight: 700;
    text-decoration: none;
}

.signup-terms a:focus-visible,
.auth-switch a:focus-visible {
    border-radius: 2px;
    outline: 2px solid rgb(var(--v-theme-primary));
    outline-offset: 3px;
}

.signup-submit {
    margin-top: 2px;
    text-transform: none;
    font-weight: 800;
}

.auth-switch {
    margin: 0;
    color: rgb(var(--v-theme-subheading));
    font-size: 0.8125rem;
    text-align: center;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-6px); }
    40%, 80% { transform: translateX(6px); }
}

.shake {
    animation: shake 0.5s ease;
}

@media (min-width: 960px) and (max-width: 1199px) {
    .signup-card {
        width: min(100%, 920px);
        grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
    }

    .signup-promo,
    .signup-form-panel {
        padding: 24px;
    }

    .signup-form {
        gap: 8px;
    }

    .signup-promo-title {
        font-size: 2rem;
    }
}

@media (max-width: 959px) {
    .signup-card {
        grid-template-columns: minmax(0, 1fr);
        width: min(100%, 460px);
    }

    .signup-promo {
        display: none;
    }
}

@media (max-width: 600px) {
    .signup-form-panel {
        padding: 24px 20px;
    }

    .signup-passwords {
        grid-template-columns: minmax(0, 1fr);
    }
}

@media (max-height: 720px) {
    .signup-promo,
    .signup-form-panel {
        padding: 20px;
    }

    .signup-promo {
        gap: 16px;
    }

    .signup-form-heading {
        margin-bottom: 10px;
    }

    .signup-form {
        gap: 8px;
    }

    .signup-chart {
        height: 80px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .shake {
        animation: none;
    }
}
</style>
