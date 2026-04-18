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
                  <v-btn :class="{ 'btn-highlight': highlight }">
                    Sign up
                  </v-btn>
                </router-link>

                <router-link to="/login">
                  <v-btn :class="{ 'btn-highlight': highlight }">
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
          <div class="text-center mt-6">
            <v-btn 
                variant="outlined"
                size="large"
                class="get-started-btn"
                @click="scrollToTop"
                    >
                Get Started
            </v-btn>
          </div>
        </v-container>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const showPage = ref(false)
const highlight = ref(false)

onMounted(() => {
    // Show page with fade-in animation after 200ms delay
    setTimeout(() => {
        showPage.value = true

        // Wait 100ms for cards to render in DOM before observing
        setTimeout(() => {
            // Create observer that watches when elements enter viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    // When card becomes visible — add class to trigger CSS animation
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible')
                    } else {
                        // Card left viewport — hide it again
                        entry.target.classList.remove('visible')
                    }
                })
            }, { threshold: 0.15 }) // fire when 15% of element is visible

            // Start observing every feature card on the page
            document.querySelectorAll('.feature-card').forEach(card => {
                observer.observe(card)
            })
        }, 600)

    }, 300)
})

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
    highlight.value = true
    setTimeout(() => highlight.value = false, 2000)
}

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

/* Initial state — cards are invisible and shifted down */
.feature-card {
  border: 1px solid rgba(255, 255, 255, 0.05);
  opacity: 0;
  transform: translateY(30px);
  transition: transform 0.3s ease, border-color 0.3s ease, opacity 0.6s ease;
}

/* Visible state — triggered by IntersectionObserver adding this class */
.feature-card.visible {
  opacity: 1;
  transform: translateY(0);
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

/* Hover effect — card lifts up and border highlights with primary color */
.feature-card:hover {
  transform: translateY(-8px);
  border-color: rgba(var(--v-theme-primary), 0.4);
}

/* Subtle scale effect on all buttons when hovered */
.v-btn:hover {
  transform: scale(1.05);
}

/* Page fade-in animation — controls entry transition duration and delay */
.page-fade-enter-active {
  transition: all 0.6s ease;
  transition-delay: 0.1s;
}

/* Starting state of page fade — invisible and slightly below position */
.page-fade-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

/* End state of page fade — fully visible at correct position */
.page-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}

/* Pulse animation applied to Sign in/Sign up buttons after scrolling back to top */
.btn-highlight {
    animation: pulse 0.5s ease 3;
}

/* Pulse keyframes — button scales up and back to normal */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Get Started button — glowing border effect using primary color */
.get-started-btn {
    border-width: 2px;
    box-shadow: 0 0 15px rgba(181, 232, 83, 0.3);
    transition: box-shadow 0.3s ease;
}

/* Stronger glow on hover for Get Started button */
.get-started-btn:hover {
    box-shadow: 0 0 25px rgba(181, 232, 83, 0.6);
}

</style>