<template>
    <v-container class="py-8">
        <!-- Welcome section with short dashboard intro -->
        <v-card variant="flat" rounded="xl" class="pa-6 border mb-6">
            <div class="d-flex flex-column flex-md-row justify-space-between align-md-center">
                <div>
                    <div class="text-title-large font-weight-bold mb-1">
                        {{ $t('home.welcome', { name: user?.username || user?.name || 'User' }) }}
                    </div>
                    <p class="text-body-medium text-medium-emphasis">
                        {{ $t('home.subtitle') }}
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
                    {{ $t('home.newWorkout') }}
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
                            {{ $t('home.weightProgress.title') }}
                        </div>
                    </div>

                    <!-- Chart is shown only when weight data exists -->
                    <div v-if="weightChartData.length" class="chart-wrapper">
                        <canvas ref="weightChartCanvas"></canvas>
                    </div>

                    <!-- Empty state for users without weight measurements -->
                    <div v-else class="empty-state">
                        <v-icon icon="mdi-chart-line" color="primary" size="42" class="mb-3"></v-icon>

                        <div class="text-title-medium font-weight-bold mb-1">
                            {{ $t('home.weightProgress.emptyTitle') }}
                        </div>

                        <div class="mb-4">
                            <p class="text-body-medium text-medium-emphasis">
                            {{ $t('home.weightProgress.emptyText') }}
                        </p>
                        </div>

                        <v-btn
                            color="primary"
                            variant="flat"
                            rounded="lg"
                            @click="$router.push('/measurements')"
                        >
                            {{ $t('home.addMeasurement') }}
                        </v-btn>
                    </div>
                </v-card>
            </v-col>

            <!-- Right dashboard overview with tabs -->
            <v-col cols="12" md="4">
                <v-card variant="flat" rounded="xl" class="pa-5 border overview-card">
                    <div class="mb-4">
                        <div class="text-title-large font-weight-bold mb-1">
                            {{ $t('home.overview.title') }}
                        </div>

                        <div class="text-body-medium text-medium-emphasis">
                            {{ $t('home.overview.subtitle') }}
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
                            {{ $t('home.overview.measurementsTab') }}
                        </v-tab>

                        <v-tab value="nutrition">
                            {{ $t('home.overview.nutritionTab') }}
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
                                    {{ $t('home.openMeasurements') }}
                                </v-btn>
                            </div>

                            <!-- Empty state for users without measurements -->
                            <div v-else class="small-empty-state">
                                <v-icon icon="mdi-scale-bathroom" color="primary" size="38" class="mb-3"></v-icon>

                                <div class="text-title-medium font-weight-bold mb-1">
                                    {{ $t('home.measurements.emptyTitle') }}
                                </div>

                                <div class="text-body-medium text-medium-emphasis mb-4">
                                    {{ $t('home.measurements.emptyText') }}
                                </div>

                                <v-btn
                                    color="primary"
                                    variant="flat"
                                    rounded="lg"
                                    @click="$router.push('/measurements')"
                                >
                                    {{ $t('home.addMeasurement') }}
                                </v-btn>
                            </div>
                        </v-window-item>

                        <!-- Daily nutrition tab -->
                        <v-window-item value="nutrition">
                            <div v-if="macroResult">
                                <div class="text-center mb-4">
                                    <div class="text-body-small text-medium-emphasis text-uppercase">
                                        {{ $t('home.nutrition.dailyTarget') }}
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
                                                {{ $t('home.nutrition.protein') }}
                                            </div>

                                            <div class="text-title-medium font-weight-bold">
                                                {{ macroResult.protein }}g
                                            </div>
                                        </v-card>
                                    </v-col>

                                    <v-col cols="4">
                                        <v-card variant="tonal" rounded="lg" class="pa-3 text-center">
                                            <div class="text-body-small text-medium-emphasis">
                                                {{ $t('home.nutrition.fats') }}
                                            </div>

                                            <div class="text-title-medium font-weight-bold">
                                                {{ macroResult.fats }}g
                                            </div>
                                        </v-card>
                                    </v-col>

                                    <v-col cols="4">
                                        <v-card variant="tonal" rounded="lg" class="pa-3 text-center">
                                            <div class="text-body-small text-medium-emphasis">
                                                {{ $t('home.nutrition.carbs') }}
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
                                    {{ $t('home.openMacros') }}
                                </v-btn>
                            </div>

                            <!-- Empty state for users without macro profile data -->
                            <div v-else class="small-empty-state">
                                <v-icon icon="mdi-calculator" color="primary" size="38" class="mb-3"></v-icon>

                                <div class="text-title-medium font-weight-bold mb-1">
                                    {{ $t('home.nutrition.emptyTitle') }}
                                </div>

                                <div class="text-body-medium text-medium-emphasis mb-4">
                                    {{ $t('home.nutrition.emptyText') }}
                                </div>

                                <v-btn
                                    color="primary"
                                    variant="flat"
                                    rounded="lg"
                                    @click="$router.push('/macros')"
                                >
                                    {{ $t('home.nutrition.calculateMacros') }}
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
import { ref, computed, onMounted, nextTick, watch } from 'vue'
import axios from 'axios'
import Chart from 'chart.js/auto'
import { user } from '@/stores/auth.js'
import { calculateMacros } from '@/utils/calculateMacros'
import { useI18n } from 'vue-i18n'

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

// Provides translation function and current language
const { t, locale } = useI18n()

// Keeps the chart instance so it can be destroyed before re-rendering
let weightChart = null

// Main dashboard navigation items
const menuItems = computed(() => [
    {
        title: t('home.quickActions.workouts.title'),
        description: t('home.quickActions.workouts.description'),
        icon: 'mdi-dumbbell',
        path: '/workouts',
    },
    {
        title: t('home.quickActions.measurements.title'),
        description: t('home.quickActions.measurements.description'),
        icon: 'mdi-scale',
        path: '/measurements',
    },
    {
        title: t('home.quickActions.macros.title'),
        description: t('home.quickActions.macros.description'),
        icon: 'mdi-calculator',
        path: '/macros',
    },
])

// Body parts shown in the latest measurements card
const bodyParts = computed(() => [
    { key: 'neck', label: t('home.bodyParts.neck') },
    { key: 'chest', label: t('home.bodyParts.chest') },
    { key: 'biceps', label: t('home.bodyParts.biceps') },
    { key: 'forearms', label: t('home.bodyParts.forearms') },
    { key: 'waist', label: t('home.bodyParts.waist') },
    { key: 'hips', label: t('home.bodyParts.hips') },
    { key: 'calves', label: t('home.bodyParts.calves') },
])

// Prepares only measurements that contain body weight
const weightChartData = computed(() => {
    return measurements.value
        .filter(m => m.weight !== null && m.weight !== undefined)
        .sort((a, b) => new Date(a.measured_at) - new Date(b.measured_at))
})

// Finds the newest measurement records
const latestMeasurementsByPart = computed(() => {
    return bodyParts.value.map(part => {
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

// Formats dates based on selected language
function formatDate(date) {
    if (!date) return ''

    return new Date(date).toLocaleDateString(locale.value === 'lv' ? 'lv-LV' : 'en-GB', {
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

// Re-render chart labels when language changes
watch(locale, async () => {
    await nextTick()

    if (weightChartData.value.length) {
        renderWeightChart()
    }
})
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