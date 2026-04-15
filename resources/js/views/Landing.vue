<template>
    <div class="hero">
        <div class="logo">WorkoutTracker</div>
        <v-container class="pt-16">
            <v-row>
                <v-col cols="5">
                    
                </v-col>

                <v-col cols="7">
                    <p class="text-display-large font-weight-black">Track Every Rep.</p>
                    <p class="text-display-large font-weight-black">Crush Every Goal.</p>
                    <p class="text-display-large font-weight-black">Build Your Legacy.</p>

                    <div class="d-flex justify-center mt-10 pl-16">
                        <router-link to="/register" class="mr-5">
                            <v-btn>
                                Sign in
                            </v-btn>
                        </router-link>

                        <router-link to="/login">
                            <v-btn>
                                Login
                            </v-btn>
                        </router-link>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>

       <div class="features-section py-16">
    <v-container>
        <v-row justify="center">
            <v-col 
                v-for="(feature, index) in features" 
                :key="index" 
                cols="12" 
                sm="6" 
                md="3"
            >
                <v-card 
                class="h-100" 
                variant="outlined"
                base-color="primary" 
                rounded="xl"
                >
                    <v-card-item>
                        <v-icon :icon="feature.icon" color="primary" class="mb-2" size="large"></v-icon>
                        <v-card-title>{{ feature.title }}</v-card-title>
                    </v-card-item>
                    <v-card-text>{{ feature.text }}</v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>

</template>

<script setup>
import { ref } from 'vue'

const features = ref([  
  {
    title: 'Workout Logging',
    text: 'Record every workout, track sets, weights, and reps in real-time.',
    icon: 'mdi-dumbbell'
  },
  {
    title: 'Body Measurements',
    text: 'Monitor your progress. Track body metrics and weight to see your transformation.',
    icon: 'mdi-scale-bathroom'
  },
  {
    title: 'Analytics & Charts',
    text: 'Visual statistics of your growth — from bicep volume to strength gains.',
    icon: 'mdi-chart-line'
  },
  {
    title: 'Macro Calculator',
    text: 'Calculate your ideal calories and macronutrients based on your goals.',
    icon: 'mdi-calculator'
  },
  {
    title: 'Starter Programs',
    text: 'Don’t know where to start? We’ve prepared a base for your first step.',
    icon: 'mdi-rocket-launch'
  }
])

</script>

<style scoped>

.logo {
    position: absolute;
    top: 24px;
    left: 32px;
    font-size: 1.5rem;
    font-weight: 700;
    
}

.hero {
    position: relative;
    height: 100vh;
    background-image: 
        linear-gradient(
            to bottom,
            rgba(0,0,0,0.3) 0%,
            rgba(18,18,18,1) 70%
        ),
        url('/images/bg_landing.jpg');
    background-size: cover;
    background-position: center;
}

</style>