<template>
  <transition name="page-fade">
    <div v-if="showPage">
      <div class="hero">
        <div class="logo">WorkoutTracker</div>
        <v-container class="pt-16">
          <v-row>
            <v-col cols="5"></v-col>

            <v-col cols="7">
              <p class="text-display-large font-weight-black">Track Every Rep.</p>
              <p class="text-display-large font-weight-black">Crush Every Goal.</p>
              <p class="text-display-large font-weight-black">Build Your Legacy.</p>

              <div class="d-flex justify-center mt-10 pl-16">
                <router-link to="/register" class="mr-5">
                  <v-btn>
                    Sign up
                  </v-btn>
                </router-link>

                <router-link to="/login">
                  <v-btn>
                    Sign in
                  </v-btn>
                </router-link>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </div>

      <!-- Future cards -->

      <div class="features-section py-6">
        <v-container>
          <!-- Section header for better conversion -->
          <v-row justify="center" class="mb-10">
            <v-col cols="12" md="8" class="text-center">
              <h2 class="text-headline-small font-weight-bold mb-4">Core Features</h2>
              <p class="text-grey-lighten-1">Everything you need to reach your fitness goals in one place.</p>
            </v-col>
          </v-row>

          <v-row justify="center">
            <!--
              Iterate through features array.
              Using md="4" to create a 3-column layout on desktops for better readability.
            -->
            <v-col
              v-for="(feature, index) in features"
              :key="index"
              cols="12"
              sm="6"
              md="4"
              class="d-flex"
            >
              <v-card
                class="feature-card flex-grow-1 pa-4"
                variant="flat"
                rounded="xl"
              >
                <!-- Center-aligned header section -->
                <v-card-item class="text-center">
                  <!-- Icon wrapper to create a distinct focal point -->
                  <div class="icon-wrapper mb-6 mt-4">
                    <v-icon
                      :icon="feature.icon"
                      color="primary"
                      size="48"
                    ></v-icon>
                  </div>

                  <v-card-title class="font-weight-bold mb-2">
                    {{ feature.title }}
                  </v-card-title>
                </v-card-item>

                <!-- Main content area -->
                <v-card-text class="text-center text-body-1 text-grey-lighten-1">
                  {{ feature.text }}
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const showPage = ref(false)

onMounted(() => {
  setTimeout(() => {
    showPage.value = true
  }, 200)
})

const features = ref([
  {
    title: 'Workout Logging',
    text: 'Log every workout with ease. Track sets, reps, and weight without breaking your flow.',
    icon: 'mdi-dumbbell'
  },
  {
    title: 'Body Measurements',
    text: 'See how your body changes over time. Keep track of weight and key measurements in one place.',
    icon: 'mdi-scale-bathroom'
  },
  {
    title: 'Analytics & Charts',
    text: 'Understand your progress with clear, visual stats — from strength gains to training volume.',
    icon: 'mdi-chart-line'
  },
  {
    title: 'Macro Calculator',
    text: 'Find your ideal calories and macros based on your goals. No guesswork needed.',
    icon: 'mdi-calculator'
  },
  {
    title: 'Starter Programs',
    text: 'New to training? Start with ready-to-use programs designed to get you going.',
    icon: 'mdi-rocket-launch'
  }
])
</script>

<style>

.logo {
  position: absolute;
  top: 24px;
  left: 32px;
  font-size: 1.5rem;
  font-weight: 700;
}

.hero {
  position: relative;
  min-height: 100vh;
  background-image:
    linear-gradient(
      to bottom,
      rgba(0, 0, 0, 0.3) 0%,
      rgba(18, 18, 18, 1) 70%
    ),
    url('/images/bg_landing.jpg');
  background-size: cover;
  background-position: center;
}

.feature-card {
  /* Manual override for theme-consistent background */
  border: 1px solid rgba(255, 255, 255, 0.05);
  transition: transform 0.3s ease, border-color 0.3s ease;
}

/*
  Visual styling for the icon container to make it
  look more like a "feature" block rather than just an icon
*/
.icon-wrapper {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 80px;
  height: 80px;
  background: rgba(var(--v-theme-primary), 0.1);
  border-radius: 20px;
}

/* Annimation */

.feature-card:hover {
  transform: translateY(-8px);
  border-color: rgba(var(--v-theme-primary), 0.4);
}

.v-btn:hover {
  transform: scale(1.05);
}

.page-fade-enter-active {
  transition: all 0.6s ease;
  transition-delay: 0.1s;
}

.page-fade-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.page-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}

</style>