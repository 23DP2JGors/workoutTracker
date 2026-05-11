<template>
    <v-container class="py-8">
        <!-- Welcome section with short dashboard intro -->
        <v-card variant="flat" rounded="xl" class="pa-6 border mb-6">
            <div class="d-flex flex-column flex-md-row justify-space-between align-md-center">
                <div>
                    <div class="text-title-large font-weight-bold mb-1">
                        Welcome back, {{ user?.username || user?.name || 'User' }}
                    </div>
                    <p class="text-body-medium text-medium-emphasis mb-0">
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
        <v-row>
            <v-col
                v-for="(item, index) in menuItems"
                :key="item.title"
                cols="12"
                sm="6"
                md="4"
            >
                <v-scroll-y-transition appear>
                    <v-card
                        :class="['feature-card', 'pa-5', 'text-center', { 'visible': isReady }]"
                        rounded="xl"
                        variant="flat"
                        class="border"
                        :style="!isReady ? { transitionDelay: `${index * 150}ms` } : { transitionDelay: '0ms' }"
                        @click="$router.push(item.path)"
                    >
                        <v-card-text>
                            <!-- Feature icon -->
                            <div class="icon-wrapper mx-auto mb-4">
                                <v-icon :icon="item.icon" color="primary" size="36"></v-icon>
                            </div>

                            <div class="text-title-large font-weight-bold mb-2">
                                {{ item.title }}
                            </div>

                            <p class="text-body-medium text-medium-emphasis mb-0">
                                {{ item.description }}
                            </p>
                        </v-card-text>
                    </v-card>
                </v-scroll-y-transition>
            </v-col>
        </v-row>

        <!-- Progress overview section -->
        <v-row class="mt-2">
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

                        <p class="text-body-medium text-medium-emphasis mb-4">
                            Add your first measurement to start tracking your weight progress.
                        </p>

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

            <!-- Latest body measurements summary -->
            <v-col cols="12" md="4">
                <v-card variant="flat" rounded="xl" class="pa-6 border progress-card">
                    <div class="mb-4">
                        <div class="text-title-large font-weight-bold mb-1">
                            Latest Measurements
                        </div>
                        <p class="text-body-medium text-medium-emphasis mb-0">
                            Your most recent body stats
                        </p>
                    </div>

                    <!-- Shows the newest measurement entry without body weight -->
                    <div v-if="latestMeasurement">
                        <div class="text-body-small text-medium-emphasis mb-4">
                            {{ formatDate(latestMeasurement.measured_at) }}
                        </div>

                        <div class="d-flex flex-wrap">
                            <template v-for="part in latestBodyParts" :key="part.key">
                                <v-chip
                                    v-if="latestMeasurement[part.key] !== null && latestMeasurement[part.key] !== undefined"
                                    size="small"
                                    color="primary"
                                    variant="tonal"
                                    class="mr-2 mb-2"
                                >
                                    {{ part.label }} {{ formatNum(latestMeasurement[part.key]) }} cm
                                </v-chip>
                            </template>
                        </div>

                        <p
                            v-if="latestMeasurement.notes"
                            class="text-body-small text-medium-emphasis mt-3 font-italic"
                        >
                            "{{ latestMeasurement.notes }}"
                        </p>

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
                    <div v-else class="empty-state">
                        <v-icon icon="mdi-scale-bathroom" color="primary" size="42" class="mb-3"></v-icon>

                        <div class="text-title-medium font-weight-bold mb-1">
                            No measurements yet
                        </div>

                        <p class="text-body-medium text-medium-emphasis mb-4">
                            Add your first body measurement to see your latest stats here.
                        </p>

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
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'
import axios from 'axios'
import Chart from 'chart.js/auto'
import { user } from '@/stores/auth.js'

// Controls the entrance animation for quick action cards
const isReady = ref(false)

// Stores all measurement records loaded from the API
const measurements = ref([])

// Canvas reference used by Chart.js
const weightChartCanvas = ref(null)

// Extracts the most recent measurement entry for summary display
const userProfile = ref(null)

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

// Filters out empty body parts from the latest measurement
const latestBodyParts = computed(() => {
    if (!latestMeasurement.value) return []

    return bodyParts.filter(part => {
        const value = latestMeasurement.value[part.key]
        return value !== null && value !== undefined
    })
})

onMounted(async () => {
    // Starts card animation after the page is mounted
    setTimeout(() => {
        isReady.value = true
    }, 100)

    // Load measurements before rendering dashboard data
    await fetchMeasurements()
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

/* Icon background used in quick action cards */
.icon-wrapper {
    width: 72px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(var(--v-theme-primary), 0.1);
    border-radius: 20px;
}

/* Keeps chart and summary cards visually balanced */
.progress-card {
    min-height: 360px;
}

/* Fixed chart height for responsive rendering */
.chart-wrapper {
    height: 260px;
    position: relative;
}

/* Centered message for empty dashboard sections */
.empty-state {
    min-height: 240px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
</style>