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
                        :class="['feature-card', 'pa-5', 'text-center', { 'visible': isReady }]"
                        rounded="xl"
                        variant="flat"
                        class="border"
                        :style="{ transitionDelay: `${index * 150}ms` }"
                        @click="$router.push(item.path)"
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
import { ref, onMounted } from 'vue';

const isReady = ref(false);

const menuItems = [
    { title: 'Workouts', description: 'Log your training sessions', icon: 'mdi-dumbbell', path: '/workouts' },
    // { title: 'Exercises', description: 'Browse 60+ exercises', icon: 'mdi-arm-flex', path: '/exercises' },
    { title: 'Measurements', description: 'Track your body changes', icon: 'mdi-scale', path: '/measurements' },
    { title: 'Macros', description: 'Calculate your daily nutrition', icon: 'mdi-calculator', path: '/macros' },
]

onMounted(() => {
    // delay to trigger transition
    setTimeout(() => {
        isReady.value = true;
    }, 100);
});
</script>

<style scoped>
/* card invisible and moved */
.feature-card {
    opacity: 0;
    transform: translateY(40px);
    /* Increase to 1.2 seconds for slow effect */
    /* Use cubic-bezier for premium feel (smooth deceleration at the end) */
    transition: 
        opacity 1.2s cubic-bezier(0.2, 0.8, 0.2, 1), 
        transform 1.2s cubic-bezier(0.2, 0.8, 0.2, 1),
        box-shadow 0.3s ease;
    cursor: pointer;
}

/* Becomes visible */
.feature-card.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Hover effect remains fast and responsive */
.feature-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
}

/* Icon wrapper */
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