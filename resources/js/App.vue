<template>
  <v-app>
    <!-- Side navigation menu -->
    <v-navigation-drawer v-model="drawer" temporary>
      <v-list-item title="Workout Menu" subtitle="Manage your fitness"></v-list-item>
      <v-divider></v-divider>
      <v-list nav>
        <v-list-item prepend-icon="mdi-home" title="Home" value="home"></v-list-item>
        <v-list-item prepend-icon="mdi-dumbbell" title="Exercises" value="exercises"></v-list-item>
        <v-list-item prepend-icon="mdi-history" title="History" value="history"></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- Top Application Bar -->
    <v-app-bar elevation="2">
      <!-- Burger icon to open the drawer -->
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      
      <v-app-bar-title>Workout Tracker</v-app-bar-title>
      
      <v-spacer></v-spacer>
      
      <!-- Theme toggle button -->
      <v-btn 
        :icon="theme.global.name.value === 'light' ? 'mdi-weather-night' : 'mdi-weather-sunny'" 
        @click="toggleTheme"
      ></v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <v-card 
          title="Welcome Back!" 
          subtitle="Ready for a new session?"
          variant="elevated"
          color="surface"
        >
          <v-card-text>
            Your training data will appear here once we connect the database.
          </v-card-text>
          
          <v-card-actions>
            <v-btn color="primary" variant="flat">
              Start Workout
              <v-icon end icon="mdi-play"></v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'
import { useTheme } from 'vuetify'

// Control the visibility of the navigation drawer
const drawer = ref(false)

// Vuetify theme control
const theme = useTheme()

/**
 * Switch between light and dark theme modes
 */
function toggleTheme() {
  // Directly toggle the theme name value
  theme.global.name.value = theme.global.name.value === 'light' ? 'dark' : 'light'
}
</script>
