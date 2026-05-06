<template>
  <v-container>
        <v-row>
            <v-col 
                v-for="item in menuItems" 
                :key="item.title"
                cols="12" sm="6" md="4"
            >
                <v-scroll-y-transition appear>
                    <v-card 
                        class="feature-card pa-6 text-center border"
                        rounded="xl"
                        variant="flat"
                        @click="$router.push(item.path)"
                        :style="{ transitionDelay: `${index * 100}ms` }" 
                    >
                        <v-card-text>
                            <!-- Icon with green background -->
                            <div class="icon-wrapper mx-auto mb-4">
                                <v-icon :icon="item.icon" color="primary" size="36"></v-icon>
                            </div>
                            <!-- Title -->
                            <h2 class="font-weight-bold mb-2">{{ item.title }}</h2>

                            <!-- Description -->
                            <p class="text-body-2 text-medium-emphasis">{{ item.description }}</p>
                        </v-card-text>
                    </v-card>
                </v-scroll-y-transition>
            </v-col>
        </v-row>
  </v-container>
</template>

<script setup>
import { onMounted } from 'vue';

const menuItems = [
    { title: 'Workouts', description: 'Log your training sessions', icon: 'mdi-dumbbell', path: '/workouts' },
    // { title: 'Exercises', description: 'Browse 60+ exercises', icon: 'mdi-arm-flex', path: '/exercises' },
    { title: 'Measurements', description: 'Track your body changes', icon: 'mdi-scale', path: '/measurements' },
    { title: 'Macros', description: 'Calculate your daily nutrition', icon: 'mdi-calculator', path: '/macros' },
    // { title: 'Programs', description: 'Follow a structured plan', icon: 'mdi-rocket-launch', path: '/programs' },
]
</script>

<style scoped>
.feature-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    cursor: pointer;
}

/* hower effect */
.feature-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.icon-wrapper {
    width: 72px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(var(--v-theme-primary), 0.1);
    border-radius: 20px;
}
</style>