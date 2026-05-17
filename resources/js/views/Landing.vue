<template>
  <transition name="page-fade">
    <div v-if="showPage">
      <div class="hero">
        <div class="logo">{{ $t('landing.logo') }}</div>

        <div class="landing-actions">
            <LanguageSwitcher />
        </div>

        <v-container class="hero-container">
            <v-row class="fill-height" align="center">
                <v-col cols="12" md="5" class="d-none d-md-block"></v-col>

                <v-col cols="12" md="7" class="hero-content">
                    <div class="hero-title font-weight-black">
                        <div>{{ $t('landing.heroLine1') }}</div>
                        <div>{{ $t('landing.heroLine2') }}</div>
                        <div>{{ $t('landing.heroLine3') }}</div>
                    </div>

                    <div class="hero-buttons d-flex justify-center justify-md-center">
                      <router-link to="/register" class="mr-4">
                          <v-btn :class="{ 'btn-highlight': highlight }">
                              {{ $t('landing.signUp') }}
                          </v-btn>
                      </router-link>

                      <router-link to="/login">
                          <v-btn :class="{ 'btn-highlight': highlight }">
                              {{ $t('landing.signIn') }}
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
              <h2 class="text-headline-small font-weight-bold mb-4">{{ $t('landing.coreFeatures') }}</h2>
              <div class="text-grey-lighten-1">
                  {{ $t('landing.coreFeaturesSubtitle') }}
              </div>
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
                {{ $t('landing.getStarted') }}
            </v-btn>
          </div>
        </v-container>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useI18n } from 'vue-i18n'
import LanguageSwitcher from '@/components/LanguageSwitcher.vue'

const showPage = ref(false)
const highlight = ref(false)

// Provides translation function for landing page content
const { t } = useI18n()

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

// Builds feature cards from translation files
const features = computed(() => [
    {
        title: t('landing.features.workoutLogging.title'),
        text: t('landing.features.workoutLogging.text'),
        icon: 'mdi-dumbbell',
    },
    {
        title: t('landing.features.bodyMeasurements.title'),
        text: t('landing.features.bodyMeasurements.text'),
        icon: 'mdi-scale-bathroom',
    },
    {
        title: t('landing.features.analytics.title'),
        text: t('landing.features.analytics.text'),
        icon: 'mdi-chart-line',
    },
    {
        title: t('landing.features.macroCalculator.title'),
        text: t('landing.features.macroCalculator.text'),
        icon: 'mdi-calculator',
    },
])
</script>

<style scoped>
/* Main logo position in the hero section */
.logo {
    position: absolute;
    top: 24px;
    left: 32px;
    z-index: 10;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Language switcher position */
.landing-actions {
    position: absolute;
    top: 20px;
    right: 32px;
    z-index: 10;
}

/* Full-screen hero section with dark overlay and background image */
.hero {
    position: relative;
    min-height: 100vh;
    background-image:
        linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.35) 0%,
            rgba(18, 18, 18, 1) 82%
        ),
        url('/images/bg_landing.jpg');
    background-size: cover;
    background-position: center;
}

/* Centers hero content vertically */
.hero-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
}

/* Desktop text alignment */
.hero-content {
    text-align: left;
    transform: translateY(-130px);
}

/* Responsive hero headline size */
.hero-title {
    font-size: clamp(2.4rem, 6vw, 4.1rem);
    line-height: 1.08;
    letter-spacing: -0.04em;
}

/* Keeps hero buttons centered under the hero text */
.hero-buttons {
    margin-top: 40px;
    display: flex;
    justify-content: right;
    transform: translateX(-80px);
}

/* Hidden state before feature cards enter viewport */
.feature-card {
    border: 1px solid rgba(255, 255, 255, 0.05);
    opacity: 0;
    transform: translateY(30px);
    transition: transform 0.3s ease, border-color 0.3s ease, opacity 0.6s ease;
}

/* Visible state added by IntersectionObserver */
.feature-card.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Icon background for feature cards */
.icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: rgba(var(--v-theme-primary), 0.1);
    border-radius: 20px;
}

/* Hover effect for feature cards */
.feature-card:hover {
    transform: translateY(-8px);
    border-color: rgba(var(--v-theme-primary), 0.4);
}

/* Small button scale on hover */
.v-btn:hover {
    transform: scale(1.05);
}

/* Page fade animation settings */
.page-fade-enter-active {
    transition: all 0.6s ease;
    transition-delay: 0.1s;
}

/* Page fade start state */
.page-fade-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

/* Page fade end state */
.page-fade-enter-to {
    opacity: 1;
    transform: translateY(0);
}

/* Highlight animation for sign buttons */
.btn-highlight {
    animation: pulse 0.5s ease 3;
}

/* Button pulse animation */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Glow effect for Get Started button */
.get-started-btn {
    border-width: 2px;
    box-shadow: 0 0 15px rgba(181, 232, 83, 0.3);
    transition: box-shadow 0.3s ease;
}

/* Stronger glow on hover */
.get-started-btn:hover {
    box-shadow: 0 0 25px rgba(181, 232, 83, 0.6);
}

/* Mobile layout adjustments */
@media (max-width: 600px) {
    /* Shorter hero and better image crop on phones */
    .hero {
        min-height: 92vh;
        background-position: center;
    }

    /* Adds spacing so content does not overlap the logo */
    .hero-container {
        min-height: 92vh;
        padding-top: 88px;
        padding-bottom: 48px;
    }

    /* Smaller logo on mobile */
    .logo {
        top: 18px;
        left: 20px;
        font-size: 1rem;
    }

    /* Keeps language switcher inside the mobile viewport */
    .landing-actions {
        top: 10px;
        right: 12px;
    }

    /* Center hero text on mobile */
    .hero-content {
        text-align: center;
        transform: translateY(-35px);
    }

    /* Smaller headline for mobile screens */
    .hero-title {
        font-size: 2.25rem;
        line-height: 1.12;
        letter-spacing: -0.03em;
    }

    /* Center buttons under the headline */
    .hero-buttons {
        margin-top: 32px;
        justify-content: right;
    }

    /* Smaller icon block in feature cards */
    .icon-wrapper {
        width: 68px;
        height: 68px;
    }
}

/* Extra adjustments for very small phones */
@media (max-width: 380px) {
    /* Prevents hero title from taking too much vertical space */
    .hero-title {
        font-size: 2rem;
    }

    /* Keeps logo compact on narrow screens */
    .logo {
        font-size: 0.95rem;
    }
}
</style>