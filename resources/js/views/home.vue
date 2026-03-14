<template>
  <v-container>
    <!-- Welcome card - moved here from App.vue -->
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
</template>

<script setup>
// Home view — rendered at route "/"
// Layout (drawer, app bar) is provided by App.vue automatically
</script>