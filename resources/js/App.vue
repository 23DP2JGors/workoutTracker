<template>
  <v-app>

    <!-- Top Application Bar - unchanged -->
    <v-app-bar v-if="route.meta.layout !== 'none' && route.meta.layout !== 'auth'" elevation="2">
      <v-app-bar-title>Workout Tracker</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn 
      color="default"
        :icon="theme.global.name.value === 'light' ? 'mdi-weather-night' : 'mdi-weather-sunny'" 
        @click="toggleTheme"
      ></v-btn>
    </v-app-bar>

    <!-- Top for auth pages -->
    <v-app-bar v-if="route.meta.layout === 'auth'" elevation="0" color="transparent">
        <v-app-bar-title class="text-title-large font-weight-bold">Workout Tracker</v-app-bar-title>
        <v-spacer></v-spacer>
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
import axios from 'axios'
import { ref } from 'vue'
import { useTheme } from 'vuetify'
import { onMounted } from 'vue'

const drawer = ref(false)
const theme = useTheme()
const route = useRoute()
const router = useRouter()

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
</script>