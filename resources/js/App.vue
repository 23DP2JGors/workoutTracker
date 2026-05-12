<template>
  <v-app>

    <!-- Top Application Bar - unchanged -->
    <v-app-bar v-if="route.meta.layout !== 'none' && route.meta.layout !== 'auth'" elevation="2">
        <v-btn 
            v-if="route.name !== 'Home'"
            color="default"
            icon="mdi-arrow-left"
            @click="router.back()"
            >
        </v-btn>
          <v-app-bar-title class="font-weight-bold">
              WorkoutTracker
          </v-app-bar-title>
      <v-spacer></v-spacer>

      <!-- User menu -->
      <v-menu>
        <template #activator="{ props }">
          <v-btn
            v-bind="props"
            variant="text"
            color="default"
            append-icon="mdi-chevron-down"
            prepend-icon="mdi-account-circle-outline"
          >
            {{ user?.username || user?.name || $t('app.account') }}
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
      
      <v-btn 
      color="default"
        :icon="theme.global.name.value === 'light' ? 'mdi-weather-night' : 'mdi-weather-sunny'" 
        @click="toggleTheme"
      ></v-btn>
    </v-app-bar>

    <!-- Top for auth pages -->
    <v-app-bar v-if="route.meta.layout === 'auth'" elevation="0" color="transparent">
        <v-app-bar-title class="text-title-large font-weight-bold">
            Workout Tracker
        </v-app-bar-title>
        <v-spacer></v-spacer>
        
        <LanguageSwitcher />
        
        <v-btn 
            color="default"
            :icon="theme.global.name.value === 'light' ? 'mdi-weather-night' : 'mdi-weather-sunny'" 
            @click="toggleTheme"
        ></v-btn>
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
import { ref } from 'vue'
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
})

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