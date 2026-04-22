<template>
    <v-container>
        <v-row class="justify-space-around">
            <v-col cols="12" md="6">

                <v-dialog transition="dialog-bottom-transition" :width="$vuetify.display.smAndDown ? '100%' : '700'">
                    <template v-slot:activator="{ props: activatorProps }">
                        <v-btn v-bind="activatorProps" text="New workout" block></v-btn>
                    </template>

                    <template v-slot:default="{ isActive }">
                        <v-card>
                            <v-toolbar :title="step === 1 ? 'New Workout' : form.name"></v-toolbar>

                            <v-card-text class="pa-6">

                                <!-- Step 1: Workout name and date -->
                                <div v-if="step === 1">
                                    <v-text-field
                                        v-model="form.name"
                                        label="Workout name"
                                        variant="outlined"
                                        class="mb-4"
                                        placeholder="e.g. Push Day"
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="form.date"
                                        label="Date"
                                        type="date"
                                        variant="outlined"
                                    ></v-text-field>
                                </div>

                                <!-- Step 2: Add exercises -->
                                <div v-if="step === 2">
                                    <v-autocomplete
                                        v-model="selectedExercise"
                                        :items="groupedExercises"
                                        label="Search exercise"
                                        variant="outlined"
                                    >
                                        <template v-slot:subheader="{ props }">
                                            <v-divider class="mb-1"></v-divider>
                                            <v-list-subheader class="font-weight-bold text-primary text-uppercase">
                                                {{ props.title }}
                                            </v-list-subheader>
                                        </template>

                                        <template v-slot:item="{ props, item }">
                                            <v-list-item v-bind="props" class="pl-8"></v-list-item>
                                        </template>
                                    </v-autocomplete>
                                </div>

                            </v-card-text>

                            <v-card-actions class="pa-4">
                                <!-- Step 1 actions -->
                                <template v-if="step === 1">
                                    <v-btn variant="text" @click="isActive.value = false">Cancel</v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" @click="step = 2" :disabled="!form.name || !form.date">
                                        Next →
                                    </v-btn>
                                </template>

                                <!-- Step 2 actions -->
                                <template v-if="step === 2">
                                    <v-btn variant="text" @click="step = 1">← Back</v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" @click="saveWorkout">
                                        Save Workout
                                    </v-btn>
                                </template>
                            </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>

                <!-- Workout list -->
                <div v-for="workout in workouts" :key="workout.id" class="mt-4">
                    {{ workout.name }} — {{ workout.date }}
                </div>

            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const workouts = ref([])
const step = ref(1)
const exercises = ref([])
const selectedExercise = ref(null)

// Form data for new workout
const form = ref({
    name: '',
    date: new Date().toISOString().split('T')[0], // today's date by default
})  

const saveWorkout = async () => {
    // Will implement after adding exercises
    console.log('saving workout', form.value)
}

const groupedExercises = computed(() => {
    const groups = {}
    
    exercises.value.forEach(exercise => {
        if (!groups[exercise.muscle_group]) {
            groups[exercise.muscle_group] = []
        }
        groups[exercise.muscle_group].push(exercise)
    })
    
    const result = []
    Object.keys(groups).sort().forEach(group => {
        result.push({ type: 'subheader', title: group })
        groups[group].forEach(exercise => {
            result.push({ title: exercise.name, value: exercise.id })
        })
    })
    
    return result
})

onMounted(async () => {
    const response = await axios.get('/api/workouts')
    workouts.value = response.data
    
    // Load exercises for selection in modal
    const exercisesResponse = await axios.get('/api/exercises')
    exercises.value = exercisesResponse.data
})

</script>

<style scoped>

</style>