<template>
  <v-app>
    <!-- Side navigation menu -->
    <v-navigation-drawer v-if="route.meta.layout !== 'none'" v-model="drawer" temporary>
      <v-list-item title="Workout Menu" subtitle="Manage your fitness"></v-list-item>
      <v-divider></v-divider>
      <v-list nav>
        <v-list-item prepend-icon="mdi-home" title="Home" value="home" to="/"></v-list-item>
        <v-list-item prepend-icon="mdi-account-plus" title="Register" value="register" to="/register"></v-list-item>
        <v-list-item prepend-icon="mdi-login" title="Login" value="login" to="/login"></v-list-item>
        <v-divider class="my-2"></v-divider>
        <v-list-item prepend-icon="mdi-dumbbell" title="Exercises" value="exercises"></v-list-item>
        <v-list-item prepend-icon="mdi-history" title="History" value="history"></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- Top Application Bar - unchanged -->
    <v-app-bar v-if="route.meta.layout !== 'none'" elevation="2">
      <v-app-bar-nav-icon @click="drawer = !drawer" color="default"></v-app-bar-nav-icon>
      <v-app-bar-title>Workout Tracker</v-app-bar-title>
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
import { useRoute } from 'vue-router'
import { fetchUser } from '@/stores/auth.js'
import { ref } from 'vue'
import { useTheme } from 'vuetify'
import { onMounted } from 'vue'

const drawer = ref(false)
const theme = useTheme()
const route = useRoute()

// Check if user is logged in when app loads
onMounted(() => {
    fetchUser()
})

function toggleTheme() {
  theme.global.name.value = theme.global.name.value === 'light' ? 'dark' : 'light'
}
</script>