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
                                        type="text"
                                        maxlength="50"
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

                                    <!-- Added exercises list -->
                                    <div v-for="(exercise, exIndex) in workoutExercises" :key="exIndex" class="mb-4 mt-4">
                                        
                                        <!-- Exercise name -->
                                        <div class="mb-4">
                                            <p class="text-title-medium font-weight-bold text-primary">{{ exercise.name }}</p>
                                        </div>  
                                        
                                        <!-- Sets table header -->
                                        <v-row class="text-body-medium text-medium-emphasis text-uppercase px-2">
                                            <v-col cols="2">set</v-col>
                                            <v-col cols="4">kg</v-col>
                                            <v-col cols="4">reps</v-col>
                                            <v-col cols="2"></v-col>
                                        </v-row>

                                        <!-- Sets -->
                                        <v-row v-for="(set, setIndex) in exercise.sets" :key="setIndex" class="mb-1 px-2 mt-1 mb-5"  align="center">
                                            <v-col cols="2">{{ setIndex + 1 }}</v-col>
                                            <v-col cols="4">
                                                <v-text-field
                                                    v-model="set.weight"
                                                    variant="outlined"
                                                    density="compact"
                                                    hide-details="auto"
                                                    type="number"
                                                    step="0.5"
                                                    placeholder="0.00"
                                                    @blur="set.weight = fixWeight(set.weight)"
                                                    @input="set.weight = set.weight.toString().slice(0, 6)"
                                                    :rules="[rules.required, rules.positiveNumber, rules.maxWeight]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="4">
                                                <v-text-field
                                                    v-model="set.reps"
                                                    variant="outlined"
                                                    density="compact"
                                                    hide-details="auto"
                                                    type="number"
                                                    @input="set.reps = set.reps.toString().slice(0, 3)"
                                                    :rules="[rules.required, rules.positiveNumber, rules.wholeNumber, rules.maxReps]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="2">
                                                <v-btn icon="mdi-close" density="compact" variant="text" @click="exercise.sets.splice(setIndex, 1)"></v-btn>
                                            </v-col>
                                        </v-row>

                                        <!-- Add set and delete button -->
                                        <v-row>
                                            <v-col>
                                            <v-btn 
                                                class="text-body-medium"
                                                variant="text" 
                                                color="primary" 
                                                @click="exercise.sets.push({ weight: '', reps: '' })" 
                                                >
                                                + Add Set
                                            </v-btn>
                                            </v-col>

                                            <v-spacer></v-spacer>

                                            <v-col class="d-flex justify-end pr-5">
                                            <v-btn 
                                                icon="mdi-delete" 
                                                variant="text" 
                                                density="compact"
                                                color="error"
                                                @click="workoutExercises.splice(exIndex, 1)"
                                            ></v-btn>
                                            </v-col>
                                        </v-row>

                                        <v-divider class="mt-3"></v-divider>
                                    </div>

                                    <!-- Add exercise button -->
                                    <v-btn variant="text" color="primary" class="mt-2" @click="addExercise" :disabled="!selectedExercise">
                                        + Add Exercise
                                    </v-btn>
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

                                    <v-alert 
                                        v-if="saveError"
                                        type="error"
                                        variant="tonal"
                                        density="compact"
                                        rounded="lg"
                                        class="mb-3"
                                        closable
                                        @click:close="saveError = null"
                                    >
                                        {{ saveError }}
                                    </v-alert>

                                    <v-alert 
                                        v-if="saveSuccess"
                                        type="success"
                                        variant="tonal"
                                        density="compact"
                                        rounded="lg"
                                        class="mb-3"
                                    >
                                        Workout saved successfully!
                                    </v-alert>

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
import { rules } from '@/utils/rules.js';

// workout save state
const saveError = ref(null)
const saveSuccess = ref(false)

// List of all workouts for the current user
const workouts = ref([])

// Controls which step of the modal is shown (1 = name/date, 2 = exercises)
const step = ref(1)

// Full list of exercises loaded from the database
const exercises = ref([])

// ID of the exercise selected in the autocomplete
const selectedExercise = ref(null)

// List of exercises added to current workout
const workoutExercises = ref([])

// Form data for creating a new workout
const form = ref({
    name: '',
    date: new Date().toISOString().split('T')[0], // default to today's date
})

const fixWeight = (val) => {
    if (!val) return val;
    // to int and round 2 digits, 
    // after parseFloat gets rid of 0
    return parseFloat(Number(val).toFixed(2));
}

// Save workout to the database
const saveWorkout = async () => {
    // Check that at least one exercise is added
    if (workoutExercises.value.length === 0) {
        saveError.value = 'Add at least one exercise before saving'
        return
    }

    // Check that all sets have weight and reps filled
    for (const exercise of workoutExercises.value) {
        if (exercise.sets.length === 0) {
            saveError.value = `Add at least one set for ${exercise.name}`
            return
        }
        for (const set of exercise.sets) {
            if (!set.weight || !set.reps) {
                saveError.value = `Fill in all sets for ${exercise.name}`
                return
            }
        }
    }

    try {
        // Step 1: Create the workout
        const workoutResponse = await axios.post('/api/workouts', form.value)
        const workout = workoutResponse.data

        // Step 2: Add each exercise to the workout
        for (const [index, exercise] of workoutExercises.value.entries()) {
            const exerciseResponse = await axios.post(
                `/api/workouts/${workout.id}/exercises`,
                { exercise_id: exercise.exercise_id, order: index }
            )
            const workoutExercise = exerciseResponse.data

            // Step 3: Add sets for each exercise
            for (const [setIndex, set] of exercise.sets.entries()) {
                await axios.post(
                    `/api/workout-exercises/${workoutExercise.id}/sets`,
                    { weight: fixWeight(set.weight), reps: set.reps, order: setIndex }
                )
            }
        }

        // Step 4: Reload workouts list and close modal
        const response = await axios.get('/api/workouts')
        workouts.value = response.data

        // Reset form
        workoutExercises.value = []
        selectedExercise.value = null
        step.value = 1
        form.value = {
            name: '',
            date: new Date().toISOString().split('T')[0],
        }

        console.log('Workout saved!')

    } catch (error) {
        console.error('Failed to save workout:', error)
        saveError.value = 'Something went wrong. Please try again.'
    }
}

// Add exercise button
const addExercise = () => {
    if (!selectedExercise.value) return
    
    // Find exercise object by id
    const exercise = exercises.value.find(e => e.id === selectedExercise.value)
    
    workoutExercises.value.push({
        id: crypto.randomUUID(),
        exercise_id: exercise.id,
        name: exercise.name,
        sets: [{ weight: '', reps: '' }] // start with one empty set
    })
    
    // Reset selection
    selectedExercise.value = null
}

// Transform flat exercises array into grouped array with subheaders
// This is recalculated automatically whenever exercises changes
const groupedExercises = computed(() => {
    const groups = {}

    // Group exercises by muscle_group field
    exercises.value.forEach(exercise => {
        if (!groups[exercise.muscle_group]) {
            groups[exercise.muscle_group] = []
        }
        groups[exercise.muscle_group].push(exercise)
    })

    // Build flat array with subheader objects between groups
    const result = []
    Object.keys(groups).sort().forEach(group => {
        // Add subheader for each muscle group
        result.push({ type: 'subheader', title: group })
        // Add exercises under that group
        groups[group].forEach(exercise => {
            result.push({ title: exercise.name, value: exercise.id })
        })
    })

    return result
})

// Load workouts and exercises when the page opens
onMounted(async () => {
    const response = await axios.get('/api/workouts')
    workouts.value = response.data

    // Load exercises for selection in the modal
    const exercisesResponse = await axios.get('/api/exercises')
    exercises.value = exercisesResponse.data
})
</script>

<style scoped>

</style>