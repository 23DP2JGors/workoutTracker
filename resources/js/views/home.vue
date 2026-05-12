<template>
    <v-container class="py-8">
        <!-- Welcome section with short dashboard intro -->
        <v-card variant="flat" rounded="xl" class="pa-6 border mb-6">
            <div class="d-flex flex-column flex-md-row justify-space-between align-md-center">
                <div>
                    <div class="text-title-large font-weight-bold mb-1">
                        Welcome back, {{ user?.username || user?.name || 'User' }}
                    </div>
                    <p class="text-body-medium text-medium-emphasis">
                        Here is your fitness overview. Track your workouts, body measurements and progress in one place.
                    </p>
                </div>

                <v-btn
                    class="mt-4 mt-md-0"
                    color="primary"
                    variant="flat"
                    rounded="lg"
                    prepend-icon="mdi-plus"
                    @click="$router.push('/workouts')"
                >
                    New Workout
                </v-btn>
            </div>
        </v-card>
        <!-- Quick navigation cards -->
        <v-row class="mb-4">
            <v-col
                v-for="(item, index) in menuItems"
                :key="item.title"
                cols="12"
                sm="6"
                md="4"
            >
                <v-scroll-y-transition appear>
                    <v-card
                        :class="['feature-card', 'pa-4', { 'visible': isReady }]"
                        rounded="xl"
                        variant="flat"
                        class="border"
                        :style="!isReady ? { transitionDelay: `${index * 150}ms` } : { transitionDelay: '0ms' }"
                        @click="$router.push(item.path)"
                    >
                        <div class="d-flex align-center">
                            <!-- Small icon block for quick actions -->
                            <div class="small-icon-wrapper mr-4">
                                <v-icon :icon="item.icon" color="primary" size="28"></v-icon>
                            </div>

                            <div>
                                <div class="text-title-medium font-weight-bold">
                                    {{ item.title }}
                                </div>

                                <p class="text-body-small text-medium-emphasis mb-0">
                                    {{ item.description }}
                                </p>
                            </div>

                            <v-spacer></v-spacer>

                            <v-icon icon="mdi-chevron-right" color="primary" size="22"></v-icon>
                        </div>
                    </v-card>
                </v-scroll-y-transition>
            </v-col>
        </v-row>

        <!-- Progress overview section -->
        <v-row>
            <!-- Weight progress chart -->
            <v-col cols="12" md="8">
                <v-card variant="flat" rounded="xl" class="pa-6 border progress-card">
                    <div class="mb-4">
                        <div class="text-title-large font-weight-bold mb-1">
                            Weight Progress
                        </div>
                        <p class="text-body-medium text-medium-emphasis mb-0">
                            Your body weight changes over time
                        </p>
                    </div>

                    <!-- Chart is shown only when weight data exists -->
                    <div v-if="weightChartData.length" class="chart-wrapper">
                        <canvas ref="weightChartCanvas"></canvas>
                    </div>

                    <!-- Empty state for users without weight measurements -->
                    <div v-else class="empty-state">
                        <v-icon icon="mdi-chart-line" color="primary" size="42" class="mb-3"></v-icon>

                        <div class="text-title-medium font-weight-bold mb-1">
                            No weight data yet
                        </div>

                        <div class="mb-4">
                            <p class="text-body-medium text-medium-emphasis">
                            Add your first measurement to start tracking your weight progress.
                        </p>
                        </div>

                        <v-btn
                            color="primary"
                            variant="flat"
                            rounded="lg"
                            @click="$router.push('/measurements')"
                        >
                            Add measurement
                        </v-btn>
                    </div>
                </v-card>
            </v-col>

            <!-- Right dashboard overview with tabs -->
            <v-col cols="12" md="4">
                <v-card variant="flat" rounded="xl" class="pa-5 border overview-card">
                    <div class="mb-4">
                        <div class="text-title-large font-weight-bold mb-1">
                            Overview
                        </div>

                        <div class="text-body-medium text-medium-emphasis">
                            Quick summary of your latest data
                        </div>
                    </div>

                    <!-- Tabs switch between measurements and nutrition -->
                    <v-tabs
                        v-model="overviewTab"
                        color="primary"
                        density="compact"
                        grow
                        class="mb-4"
                    >
                        <v-tab value="measurements">
                            Measurements
                        </v-tab>

                        <v-tab value="nutrition">
                            Nutrition
                        </v-tab>
                    </v-tabs>

                    <v-window v-model="overviewTab">
                        <!-- Latest measurements tab -->
                        <v-window-item value="measurements">
                            <div v-if="measurements.length">
                                <v-row dense>
                                    <v-col
                                        v-for="part in latestMeasurementsByPart"
                                        :key="part.key"
                                        cols="6"
                                    >
                                        <v-card
                                            variant="tonal"
                                            rounded="lg"
                                            class="pa-3 measurement-mini-card"
                                        >
                                            <div class="text-body-small text-medium-emphasis">
                                                {{ part.label }}
                                            </div>

                                            <div class="text-title-medium font-weight-bold text-primary">
                                                {{ part.value ? `${formatNum(part.value)} cm` : '—' }}
                                            </div>

                                            <div class="text-label-small text-medium-emphasis">
                                                {{ part.date ? formatDate(part.date) : 'No data' }}
                                            </div>
                                        </v-card>
                                    </v-col>
                                </v-row>

                                <v-btn
                                    class="mt-4"
                                    variant="outlined"
                                    color="primary"
                                    rounded="lg"
                                    block
                                    @click="$router.push('/measurements')"
                                >
                                    Open measurements
                                </v-btn>
                            </div>

                            <!-- Empty state for users without measurements -->
                            <div v-else class="small-empty-state">
                                <v-icon icon="mdi-scale-bathroom" color="primary" size="38" class="mb-3"></v-icon>

                                <div class="text-title-medium font-weight-bold mb-1">
                                    No measurements yet
                                </div>

                                <div class="text-body-medium text-medium-emphasis mb-4">
                                    Add your first body measurement to see your stats here.
                                </div>

                                <v-btn
                                    color="primary"
                                    variant="flat"
                                    rounded="lg"
                                    @click="$router.push('/measurements')"
                                >
                                    Add measurement
                                </v-btn>
                            </div>
                        </v-window-item>

                        <!-- Daily nutrition tab -->
                        <v-window-item value="nutrition">
                            <div v-if="macroResult">
                                <div class="text-center mb-4">
                                    <div class="text-body-small text-medium-emphasis text-uppercase">
                                        Daily Target
                                    </div>

                                    <div class="text-display-small font-weight-bold text-primary">
                                        {{ macroResult.calories }}
                                        <span class="text-title-medium text-medium-emphasis">kcal</span>
                                    </div>
                                </div>

                                <v-row dense>
                                    <v-col cols="4">
                                        <v-card variant="tonal" rounded="lg" class="pa-3 text-center">
                                            <div class="text-body-small text-medium-emphasis">
                                                Protein
                                            </div>

                                            <div class="text-title-medium font-weight-bold">
                                                {{ macroResult.protein }}g
                                            </div>
                                        </v-card>
                                    </v-col>

                                    <v-col cols="4">
                                        <v-card variant="tonal" rounded="lg" class="pa-3 text-center">
                                            <div class="text-body-small text-medium-emphasis">
                                                Fats
                                            </div>

                                            <div class="text-title-medium font-weight-bold">
                                                {{ macroResult.fats }}g
                                            </div>
                                        </v-card>
                                    </v-col>

                                    <v-col cols="4">
                                        <v-card variant="tonal" rounded="lg" class="pa-3 text-center">
                                            <div class="text-body-small text-medium-emphasis">
                                                Carbs
                                            </div>

                                            <div class="text-title-medium font-weight-bold">
                                                {{ macroResult.carbs }}g
                                            </div>
                                        </v-card>
                                    </v-col>
                                </v-row>

                                <v-btn
                                    class="mt-4"
                                    variant="outlined"
                                    color="primary"
                                    rounded="lg"
                                    block
                                    @click="$router.push('/macros')"
                                >
                                    Open macros
                                </v-btn>
                            </div>

                            <!-- Empty state for users without macro profile data -->
                            <div v-else class="small-empty-state">
                                <v-icon icon="mdi-calculator" color="primary" size="38" class="mb-3"></v-icon>

                                <div class="text-title-medium font-weight-bold mb-1">
                                    No macro data yet
                                </div>

                                <div class="text-body-medium text-medium-emphasis mb-4">
                                    Fill in your profile to calculate daily calories and macros.
                                </div>

                                <v-btn
                                    color="primary"
                                    variant="flat"
                                    rounded="lg"
                                    @click="$router.push('/macros')"
                                >
                                    Calculate macros
                                </v-btn>
                            </div>
                        </v-window-item>
                    </v-window>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'
import axios from 'axios'
import Chart from 'chart.js/auto'
import { user } from '@/stores/auth.js'
import { calculateMacros } from '@/utils/calculateMacros'

// Controls the entrance animation for quick action cards
const isReady = ref(false)

// Stores all measurement records loaded from the API
const measurements = ref([])

// Canvas reference used by Chart.js
const weightChartCanvas = ref(null)

// Extracts the most recent measurement entry for summary display
const userProfile = ref(null)

// Controls the right overview card tabs
const overviewTab = ref('measurements')

// Keeps the chart instance so it can be destroyed before re-rendering
let weightChart = null

// Main dashboard navigation items
const menuItems = [
    { title: 'Workouts', description: 'Log your training sessions', icon: 'mdi-dumbbell', path: '/workouts' },
    { title: 'Measurements', description: 'Track your body changes', icon: 'mdi-scale', path: '/measurements' },
    { title: 'Macros', description: 'Calculate your daily nutrition', icon: 'mdi-calculator', path: '/macros' },
]

// Body parts shown in the latest measurements card
const bodyParts = [
    { key: 'neck', label: 'Neck' },
    { key: 'chest', label: 'Chest' },
    { key: 'biceps', label: 'Biceps' },
    { key: 'forearms', label: 'Forearms' },
    { key: 'waist', label: 'Waist' },
    { key: 'hips', label: 'Hips' },
    { key: 'calves', label: 'Calves' },
]

// Prepares only measurements that contain body weight
const weightChartData = computed(() => {
    return measurements.value
        .filter(m => m.weight !== null && m.weight !== undefined)
        .sort((a, b) => new Date(a.measured_at) - new Date(b.measured_at))
})

// Finds the newest measurement records
const latestMeasurementsByPart = computed(() => {
    return bodyParts.map(part => {
        const latestEntry = [...measurements.value]
            .filter(m => m[part.key] !== null && m[part.key] !== undefined)
            .sort((a, b) => new Date(b.measured_at) - new Date(a.measured_at))[0]

        return {
            ...part,
            value: latestEntry ? latestEntry[part.key] : null,
            date: latestEntry ? latestEntry.measured_at : null,
        }
    })
})

// Calculates daily macros from saved user profile data
const macroResult = computed(() => {
    return calculateMacros(userProfile.value)
})

onMounted(async () => {
    // Starts card animation after the page is mounted
    setTimeout(() => {
        isReady.value = true
    }, 100)

     // Load dashboard data before rendering charts and cards
    await fetchMeasurements()
    await fetchUserProfile()
    await nextTick()

    // Render chart only when there is weight data
    if (weightChartData.value.length) {
        renderWeightChart()
    }
})

// Loads measurements from Laravel API
async function fetchMeasurements() {
    const response = await axios.get('/api/measurements')
    measurements.value = response.data
}

// Loads user profile data for personalized dashboard greeting
async function fetchUserProfile() {
    const response = await axios.get('/api/user-profile')
    userProfile.value = response.data
}


// Creates the weight progress line chart
function renderWeightChart() {
    if (!weightChartCanvas.value) return

    // Prevents duplicate chart instances
    if (weightChart) {
        weightChart.destroy()
    }

    const labels = weightChartData.value.map(m => formatDate(m.measured_at))
    const values = weightChartData.value.map(m => Number(m.weight))

    weightChart = new Chart(weightChartCanvas.value, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Weight',
                    data: values,
                    tension: 0.35,
                    fill: false,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    ticks: {
                        callback: value => `${value} kg`,
                    },
                },
            },
        },
    })
}

// Formats database dates for display
function formatDate(date) {
    if (!date) return ''

    return new Date(date).toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
    })
}

// Formats decimal values without unnecessary zeroes
function formatNum(value) {
    if (value === null || value === undefined) return ''

    return Number(value).toFixed(1).replace('.0', '')
}
</script>

<style scoped>
/* Base state for animated feature cards */
.feature-card {
    opacity: 0;
    transform: translateY(40px);
    transition:
        opacity 1.2s cubic-bezier(0.2, 0.8, 0.2, 1),
        transform 1.2s cubic-bezier(0.2, 0.8, 0.2, 1),
        box-shadow 0.3s ease;
    cursor: pointer;
}

/* Visible state after page load */
.feature-card.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Small hover movement for clickable cards */
.feature-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.18) !important;
}

/* Compact icon background for quick navigation cards */
.small-icon-wrapper {
    width: 52px;
    height: 52px;
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(var(--v-theme-primary), 0.1);
    border-radius: 16px;
}

/* Main dashboard card height */
.progress-card {
    min-height: 430px;
}

/* Fixed chart height for responsive rendering */
.chart-wrapper {
    height: 330px;
    position: relative;
}

/* Measurement row layout */
.measurement-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(var(--v-theme-on-surface), 0.08);
}

.measurement-row:last-child {
    border-bottom: none;
}

.overview-card {
    min-height: 430px;
}

.measurement-mini-card {
    min-height: 92px;
}

/* Centered empty state for large cards */
.empty-state {
    min-height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

/* Centered empty state for smaller cards */
.small-empty-state {
    min-height: 280px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
</style>