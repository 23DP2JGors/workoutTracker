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
        }, 500)

const menuItems = [
    { title: 'Workouts', description: 'Log your training sessions', icon: 'mdi-dumbbell', path: '/workouts' },
    { title: 'Exercises', description: 'Browse 60+ exercises', icon: 'mdi-arm-flex', path: '/exercises' },
    { title: 'Measurements', description: 'Track your body changes', icon: 'mdi-scale', path: '/measurements' },
    { title: 'Macros', description: 'Calculate your daily nutrition', icon: 'mdi-calculator', path: '/macros' },
    { title: 'Programs', description: 'Follow a structured plan', icon: 'mdi-rocket-launch', path: '/programs' },
]
</script>

<style scoped>
/* Cards are invisible */
.feature-card {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

/* When IntersectionObserver adding visible class */
.feature-card.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Hover effect */
.feature-card:hover {
    transform: translateY(-6px);
}
</style>