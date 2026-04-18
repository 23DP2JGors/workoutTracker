<template>
  <v-container>
        <v-row>
            <v-col 
                v-for="item in menuItems" 
                :key="item.title"
                cols="12" sm="6" md="4"
            >
                <v-card 
                    class="feature-card pa-6 text-center"
                    rounded="xl"
                    @click="$router.push(item.path)"
                >
                    <v-card-text>
                         <!-- Icon with green background -->
                        <div class="icon-wrapper mx-auto mb-4">
                            <v-icon :icon="item.icon" color="primary" size="36"></v-icon>
                        </div>
                        <!-- Title -->
                        <p class="font-weight-bold text-h6 mb-2">{{ item.title }}</p>

                        <!-- Description -->
                        <p class="text-body-2 text-medium-emphasis">{{ item.description }}</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
  </v-container>
</template>

<script setup>

const menuItems = [
    { title: 'Workouts', description: 'Log your training sessions', icon: 'mdi-dumbbell', path: '/workouts' },
    { title: 'Exercises', description: 'Browse 60+ exercises', icon: 'mdi-arm-flex', path: '/exercises' },
    { title: 'Measurements', description: 'Track your body changes', icon: 'mdi-scale', path: '/measurements' },
    { title: 'Macros', description: 'Calculate your daily nutrition', icon: 'mdi-calculator', path: '/macros' },
    { title: 'Programs', description: 'Follow a structured plan', icon: 'mdi-rocket-launch', path: '/programs' },
]
</script>