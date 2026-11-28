<template>
  <v-app>

    <!-- Landing page top bar -->
    <v-app-bar v-if="route.meta.layout === 'none'" class="app-bar app-bar--landing" fixed elevation="0">
        <v-app-bar-title class="text-title-large font-weight-bold app-title">
            <span class="d-none d-sm-inline">Workout Tracker</span>
            <span class="d-inline d-sm-none">WT</span>
        </v-app-bar-title>
        <v-spacer></v-spacer>

        <v-btn
            v-if="route.name !== 'Login'"
            to="/login"
            variant="tonal"
            color="primary"
            rounded="lg"
            class="app-bar-sign-in"
        >
            {{ $t('landing.signIn') }}
        </v-btn>
        
        <LanguageSwitcher />
    </v-app-bar>

    <!-- Top Application Bar - unchanged -->
    <v-app-bar v-if="route.meta.layout !== 'none' && route.meta.layout !== 'auth'" class="app-bar" fixed elevation="2">
        <v-btn
            v-if="route.name !== 'Home'"
            icon="mdi-arrow-left"
            class="app-bar-back"
            :aria-label="$t('app.goBack')"
            @click="router.back()"
        />
          <v-app-bar-title class="font-weight-bold app-title">
              <span class="d-none d-sm-inline">WorkoutTracker</span>
              <span class="d-inline d-sm-none">WT</span>
          </v-app-bar-title>
      <v-spacer></v-spacer>

      <!-- User menu -->
      <v-menu>
        <template #activator="{ props }">
          <v-btn
              v-bind="props"
              variant="text"
              color="default"
              class="account-btn"
              :append-icon="$vuetify.display.smAndUp ? 'mdi-chevron-down' : undefined"
              prepend-icon="mdi-account-circle-outline"
          >
              <span class="d-none d-sm-inline">
                  {{ user?.username || user?.name || $t('app.account') }}
              </span>
          </v-btn>
        </template>

        <v-card min-width="220" rounded="lg">
          <v-list density="compact">
              <v-list-item
              prepend-icon="mdi-logout"
              :title="$t('app.logout')"
              @click="handleLogout"
            />

            <v-divider class="my-1"></v-divider>

            <v-list-item
              prepend-icon="mdi-delete-outline"
              :title="$t('app.deleteAccount')"
              class="text-error"
              @click="deleteDialog = true"
            />
          </v-list>
        </v-card>
      </v-menu>

      <!-- Delete account dialog -->
      <v-dialog v-model="deleteDialog" max-width="420">
        <v-card rounded="xl" class="pa-2">
          <v-card-title class="text-title-large font-weight-bold">
            {{ $t('app.deleteAccountTitle') }}
          </v-card-title>

          <v-card-text class="text-body-medium text-medium-emphasis">
            {{ $t('app.deleteAccountText') }}
          </v-card-text>

          <v-card-actions class="px-4 pb-4">
            <v-spacer></v-spacer>

            <v-btn
              variant="text"
              color="default"
              @click="deleteDialog = false"
            >
              {{ $t('app.cancel') }}
            </v-btn>

            <v-btn
              color="error"
              variant="flat"
              @click="handleDeleteAccount"
            >
              {{ $t('app.delete') }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      
      <LanguageSwitcher />
    </v-app-bar>

    <!-- Top for auth pages -->
    <v-app-bar v-if="route.meta.layout === 'auth'" class="app-bar app-bar--auth" fixed height="64" elevation="0">
        <v-btn
            to="/"
            icon="mdi-arrow-left"
            class="app-bar-back"
            :aria-label="$t('app.backToLanding')"
        />
        <v-app-bar-title class="text-title-large font-weight-bold app-title">
            <router-link
                to="/"
                class="auth-brand"
                :aria-label="$t('landing.logo')"
            >
                {{ $t('landing.logo') }}
            </router-link>
        </v-app-bar-title>
        <v-spacer></v-spacer>

        <v-btn
            :to="route.name === 'Login' ? '/register' : '/login'"
            variant="tonal"
            color="primary"
            rounded="lg"
            class="app-bar-sign-in"
        >
            {{ route.name === 'Login' ? $t('login.register') : $t('register.login') }}
        </v-btn>

        <LanguageSwitcher />
    </v-app-bar>
    <!-- Main content: now ONLY router-view, no hardcoded card -->
    <v-main :class="route.meta.layout === 'none' ? 'pa-0' : ''">
      <router-view />
      
    </v-main>
  </v-app>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { fetchUser, user } from '@/stores/auth.js'
import LanguageSwitcher from '@/components/LanguageSwitcher.vue'
import axios from 'axios'
import { ref, watch } from 'vue'
import { useTheme } from 'vuetify'
import { onMounted } from 'vue'


const drawer = ref(false)
const theme = useTheme()
const route = useRoute()
const router = useRouter()
const deleteDialog = ref(false)

// Check if user is logged in when app loads
onMounted(() => {
    fetchUser()

    if (route.meta.layout === 'none') {
        theme.global.name.value = 'dark'
    }
})

watch(
    () => route.meta.layout,
    layout => {
        if (layout === 'none') {
            theme.global.name.value = 'dark'
        }
    }
)

function toggleTheme() {
  theme.global.name.value = theme.global.name.value === 'light' ? 'dark' : 'light'
}

// Logout
const handleLogout = async () => {
    await axios.post('/logout')
    user.value = null
    await router.push('/')
}

// Delete account
const handleDeleteAccount = async () => {
    await axios.delete('/api/user')
    user.value = null
    deleteDialog.value = false
    await router.push('/')
}
</script>

<style scoped>
/* Prevents the app title from taking too much space on small screens */
.app-title {
    flex: 0 1 auto;
    min-width: auto;
}

/* Keeps account button compact on mobile */
.account-btn {
    min-width: 40px;
}

/* Keeps navigation readable over every route */
.app-bar {
    z-index: 1007;
}

.app-bar--landing {
    background: color-mix(in srgb, rgb(var(--v-theme-background)) 72%, transparent) !important;
    border-bottom: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 6%, transparent);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
}

.app-bar-sign-in {
    margin-inline-end: 12px;
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-primary)) 30%, transparent);
}

.app-bar-back {
    flex: 0 0 40px;
    width: 40px;
    height: 40px;
    border: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 14%, transparent);
    border-radius: 999px;
    color: rgb(var(--v-theme-on-surface));
    background: rgb(var(--v-theme-surface));
    transition:
        color 160ms ease,
        background-color 160ms ease,
        border-color 160ms ease,
        transform 120ms ease;
}

.app-bar-back:hover {
    border-color: color-mix(in srgb, rgb(var(--v-theme-primary)) 45%, transparent);
    color: rgb(var(--v-theme-primary));
    background: rgb(var(--v-theme-surface-bright));
}

.app-bar-back:active {
    transform: scale(0.96);
    color: rgb(var(--v-theme-on-primary));
    background: rgb(var(--v-theme-primary));
}

.app-bar-back:focus-visible {
    outline: 2px solid rgb(var(--v-theme-primary));
    outline-offset: 2px;
}

.app-bar--auth {
    background: color-mix(in srgb, rgb(var(--v-theme-background)) 82%, transparent) !important;
    border-bottom: 1px solid color-mix(in srgb, rgb(var(--v-theme-on-surface)) 8%, transparent);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

.auth-brand {
    color: rgb(var(--v-theme-on-surface));
    text-decoration: none;
}

.auth-brand:focus-visible {
    outline: 2px solid rgb(var(--v-theme-primary));
    outline-offset: 4px;
}

.app-bar--auth :deep(.v-toolbar__content) {
    min-height: 64px;
}
</style>