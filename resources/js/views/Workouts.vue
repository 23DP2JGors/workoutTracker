<template>
  <v-container>
    <v-row class="mb-6" dense>
      <v-col cols="12" sm="4">
        <v-card variant="flat" class="pa-4">
          <v-row align="center" no-gutters>
            <v-col cols="auto">
              <v-icon size="28" class="text-primary">mdi-calendar-check</v-icon>
            </v-col>
            <v-col>
              <div class="text-caption text-uppercase text-medium-emphasis mb-2">Total Workouts</div>
              <div class="text-h4 font-weight-bold">{{ totalWorkouts }}</div>
            </v-col>
          </v-row>
        </v-card>
      </v-col>

      <v-col cols="12" sm="4">
        <v-card variant="flat" class="pa-4">
          <v-row align="center" no-gutters>
            <v-col cols="auto">
              <v-icon size="28" class="text-primary">mdi-fire</v-icon>
            </v-col>
            <v-col>
              <div class="text-caption text-uppercase text-medium-emphasis mb-2">This Week</div>
              <div class="text-h4 font-weight-bold">{{ thisWeekWorkouts }}</div>
            </v-col>
          </v-row>
        </v-card>
      </v-col>

      <v-col cols="12" sm="4">
        <v-card variant="flat" class="pa-4">
          <v-row align="center" no-gutters>
            <v-col cols="auto">
              <v-icon size="28" class="text-primary">mdi-clock-outline</v-icon>
            </v-col>
            <v-col>
              <div class="text-caption text-uppercase text-medium-emphasis mb-2">Days Since Last</div>
              <div class="text-h4 font-weight-bold">{{ daysSinceLastWorkout }}</div>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <v-row class="justify-space-around">
      <v-col cols="12" md="6">
      <v-dialog 
          v-model="isDialogOpen" 
          transition="dialog-bottom-transition" 
          :width="$vuetify.display.smAndDown ? '100%' : '700'"
          >                    
          <template v-slot:activator="{ props: activatorProps }">
            <v-btn v-bind="activatorProps" text="New workout" block @click="openNewModal"></v-btn>
          </template>

          <template v-slot:default="{ isActive }">
            <v-card>
              <v-toolbar :title="isEditing ? 'Edit Workout' : (step === 1 ? 'New Workout' : form.name)"></v-toolbar>

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
                  <v-form ref="formRef">
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
                  </v-form>
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

                  <v-btn 
                    color="primary" 
                    :loading="isSaving" 
                    @click="saveWorkout"
                  >
                    Save Workout
                  </v-btn>
                </template>
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>

        <!-- Workout History Section -->
        <v-card variant="flat" rounded="xl" class="pa-6 border mt-6">
            <h2 class="font-weight-bold mb-1">Workout History</h2>
            <p class="text-medium-emphasis text-body-2 pb-4">
                View and manage your past workouts
            </p>

            <!-- Scrollable List of Workouts -->
            <div style="max-height: 500px; overflow-y: auto;" class="pr-2">

                <!-- Empty state alert -->
                <v-alert v-if="!workouts.length" type="info" variant="tonal" rounded="lg">
                    No workouts yet. Start by creating a new workout.
                </v-alert>

                <!-- Main Loop for workout history entries -->
                <v-card
                    v-for="workout in workouts"
                    :key="workout.id"
                    variant="outlined"
                    rounded="xl"
                    class="pa-3 mb-4 border workout-card"
                    @click="openWorkout(workout)"
                >
                    <v-row align="center">
                        <!-- Workout Data Column -->
                        <v-col cols="12" sm="8">
                            <div class="font-weight-bold mb-1 text-primary ">
                                {{ workout.name || 'Workout' }}
                            </div>

                            <div class="text-body-small text-medium-emphasis mb-3">
                                {{ formatWorkoutDate(workout.date) }}
                            </div>

                            <div class="d-flex flex-wrap">
                                <v-chip
                                    variant="tonal"
                                    color="primary"
                                    size="small"
                                    class="mr-2 mb-2 text-caption"
                                >
                                    {{ exerciseCount(workout) }} exercises
                                </v-chip>

                                <v-chip
                                    variant="outlined"
                                    size="small"
                                    class="mr-2 mb-2 text-caption"
                                >
                                    {{ setCount(workout) }} sets
                                </v-chip>
                            </div>
                        </v-col>

                        <!-- Right Side Column -->
                        <v-col cols="12" sm="4" class="d-flex justify-end align-center">
                            <v-btn
                                icon="mdi-chevron-right"
                                variant="text"
                                size="small"
                                color="primary"
                            ></v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </div>
        </v-card>
      </v-col>
    </v-row>
    <!-- Success notification -->
    <v-snackbar
      v-model="successSnackbar"
      color="success"
      location="bottom"
      elevation="24"
      :timeout="3000"
    >
      Workout saved successfully!
      
      <template v-slot:actions>
        <v-btn variant="text" @click="successSnackbar = false">Close</v-btn>
      </template>
    </v-snackbar>

    <!-- Error notification -->
    <v-snackbar
      v-model="errorSnackbar"
      color="error"
      location="bottom"
      elevation="24"
      :timeout="5000"
    >
      Failed to save workout. Please try again.
      
      <template v-slot:actions>
        <v-btn variant="text" @click="errorSnackbar = false">Close</v-btn>
      </template>
    </v-snackbar>
    <v-dialog v-model="detailDialog" max-width="600" transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar :title="selectedWorkout?.name">
          <template v-slot:append>
             <v-btn icon="mdi-pencil" variant="text" @click="openEditModal(selectedWorkout)" class="mr-2"></v-btn>                        
             <v-btn color="error" variant="text" @click="deleteWorkout" class="mr-10">
              Delete workout
            </v-btn>
          </template>
        </v-toolbar>
        <v-card-text>
          <p class="text-medium-emphasis mb-4">{{ formatWorkoutDate(selectedWorkout?.date) }}</p>
          
          <div v-for="ex in selectedWorkout?.workout_exercises" :key="ex.id" class="mb-4">
            <div class="mb-3">
              <p class="font-weight-bold text-primary">{{ ex.exercise?.name }}</p>
            </div>
            <v-row class="text-caption text-uppercase text-medium-emphasis px-2 no-gutters mb-n5">
              <v-col cols="2">set</v-col>
              <v-col cols="5">kg</v-col>
              <v-col cols="5">reps</v-col>
            </v-row>
            <v-row v-for="(set, i) in ex.sets" :key="set.id" class="px-2 no-gutters" align="center">
              <v-col cols="2" class="mb-n3">{{ i + 1 }}</v-col>
              <v-col cols="5" class="mb-n3">{{ formatWeight(set.weight) }}</v-col>
              <v-col cols="5" class="mb-n3">{{ set.reps }}</v-col>
            </v-row>
            <v-divider class="mt-3"></v-divider>
          </div>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="detailDialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { rules } from '@/utils/rules.js';

const saveError = ref(null)
const saveSuccess = ref(false)
const isDialogOpen = ref(false) // Local state to control the modal
const formRef = ref(null) // Reference to the form
const isSaving = ref(false) // Loading state for the button
const workouts = ref([]) // List of all workouts for the current user
const step = ref(1) // Controls which step of the modal is shown (1 = name/date, 2 = exercises)
const exercises = ref([]) // Full list of exercises loaded from the database
const selectedExercise = ref(null) // ID of the exercise selected in the autocomplete
const workoutExercises = ref([]) // List of exercises added to current workout
const successSnackbar = ref(false) // Controls the visibility of the notification
const errorSnackbar = ref(false) // Controls the visibility of the error notification
// workouts history stats
const detailDialog = ref(false)
const selectedWorkout = ref(null)
const isEditing = ref(false) // Flag to indicate if we're editing an existing workout
const editingWorkoutId = ref(null) // ID of the workout being edited
const deletedExerciseIds = ref([]) // IDs of exercises removed while editing

const totalWorkouts = computed(() => workouts.value?.length ?? 0)

// open workout details dialog
const openWorkout = (workout) => {
    selectedWorkout.value = workout
    detailDialog.value = true
}

// Delete workout and all related exercises and sets
const deleteWorkout = async () => {
    try {
        await axios.delete(`/api/workouts/${selectedWorkout.value.id}`)
        workouts.value = workouts.value.filter(w => w.id !== selectedWorkout.value.id)
        detailDialog.value = false
    } catch (error) {
        console.error('Failed to delete workout:', error)
    }
}

// Open edit modal with existing workout data
const openEditModal = (workout) => {
    isEditing.value = true
    editingWorkoutId.value = workout.id
    deletedExerciseIds.value = []
    form.value = {
        name: workout.name,
        date: workout.date
    }
    workoutExercises.value = workout.workout_exercises.map(we => ({
        id: we.id,
        exercise_id: we.exercise.id,
        name: we.exercise.name,
        sets: we.sets.map(s => ({ id: s.id, weight: s.weight, reps: s.reps }))
    }))
    isDialogOpen.value = true
    step.value = 1
}

// Open new workout modal and reset all fields
const openNewModal = () => {
    isEditing.value = false
    editingWorkoutId.value = null
    deletedExerciseIds.value = []
    form.value = {
        name: '',
        date: new Date().toISOString().split('T')[0],
    }
    workoutExercises.value = []
    selectedExercise.value = null
    step.value = 1
    isDialogOpen.value = true
}

// Format weight to remove trailing zeros (e.g., 10.00 -> 10, but 10.50 stays 10.5)
const formatWeight = (weight) => {
    return Number(weight) % 1 === 0 ? parseInt(weight) : parseFloat(weight)
}

const thisWeekWorkouts = computed(() => {
    const today = new Date()
    const startOfWeek = new Date(today)
    const day = startOfWeek.getDay()
    const diff = (day + 6) % 7
    startOfWeek.setDate(startOfWeek.getDate() - diff)
    startOfWeek.setHours(0, 0, 0, 0)

    return (workouts.value ?? []).filter(workout => {
        if (!workout?.date) return false
        const workoutDate = new Date(workout.date)
        if (Number.isNaN(workoutDate.getTime())) return false
        workoutDate.setHours(0, 0, 0, 0)
        return workoutDate >= startOfWeek && workoutDate <= today
    }).length
})

const lastWorkout = computed(() => {
    const validDates = (workouts.value ?? [])
        .map(workout => new Date(workout?.date))
        .filter(date => !Number.isNaN(date.getTime()))
        .sort((a, b) => b - a)

    return validDates.length ? validDates[0] : null
})

const daysSinceLastWorkout = computed(() => {
    if (!lastWorkout.value) return 'N/A'

    const today = new Date()
    today.setHours(0, 0, 0, 0)

    const lastDate = new Date(lastWorkout.value)
    lastDate.setHours(0, 0, 0, 0)

    const diffDays = Math.round((today - lastDate) / (1000 * 60 * 60 * 24))
    return Math.max(0, diffDays)
})

const formatWorkoutDate = (dateString) => {
    if (!dateString) return 'N/A'
    const date = new Date(dateString)
    if (Number.isNaN(date.getTime())) return 'N/A'

    return date.toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'long',
    })
}

const exerciseCount = (workout) => {
    return workout.workout_exercises?.length || 0;
}

const setCount = (workout) => {
    if (!workout.workout_exercises) return 0;
    return workout.workout_exercises.reduce((total, ex) => {
        return total + (ex.sets?.length || 0);
    }, 0);
}

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
    // 1. Reset error state
    saveError.value = null;

    // 2. Validate all fields (kg, reps, etc.) using Vuetify rules
    const { valid } = await formRef.value.validate();
    
    // If any field is invalid (e.g., -10kg), stop here
    if (!valid) {
        saveError.value = 'Please correct the errors in the sets before saving';
        return;
    }

    // 3. Keep your manual check for exercise existence
    if (workoutExercises.value.length === 0) {
        saveError.value = 'Add at least one exercise before saving';
        return;
    }

    try {
        isSaving.value = true; // Start loading animation

        if (isEditing.value) {
            // 1. Update basic info (name, date)
            await axios.put(`/api/workouts/${editingWorkoutId.value}`, form.value)

            // 2. Fetch all existing workout_exercises to delete them first
            // This ensures a clean slate for the update
            const currentWorkout = await axios.get(`/api/workouts/${editingWorkoutId.value}`)
            for (const ex of currentWorkout.data.workout_exercises) {
                await axios.delete(`/api/workout-exercises/${ex.id}`)
            }

            // 3. Now just save EVERYTHING currently in the list as if it's new
            for (const [index, exercise] of workoutExercises.value.entries()) {
                const exerciseResponse = await axios.post(
                    `/api/workouts/${editingWorkoutId.value}/exercises`,
                    { exercise_id: exercise.exercise_id, order: index }
                )
                const workoutExercise = exerciseResponse.data

                for (const [setIndex, set] of exercise.sets.entries()) {
                    await axios.post(
                        `/api/workout-exercises/${workoutExercise.id}/sets`,
                        { weight: fixWeight(set.weight), reps: set.reps, order: setIndex }
                    )
                }
            }
        } else {
            // Create new workout
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
        }
        
        // Step 4: Finalize
        const response = await axios.get('/api/workouts');
        workouts.value = response.data;

        // Reset form and UI
        workoutExercises.value = [];
        selectedExercise.value = null;
        deletedExerciseIds.value = [];
        step.value = 1;
        form.value = {
            name: '',
            date: new Date().toISOString().split('T')[0],
        };
        isEditing.value = false;
        editingWorkoutId.value = null;

        // CLOSE DIALOG ON SUCCESS
        isDialogOpen.value = false;
        detailDialog.value = false;
        successSnackbar.value = true;

    } catch (error) {
        errorSnackbar.value = true;
        saveError.value = 'Something went wrong. Please try again.';
    } finally {
        isSaving.value = false; // Stop loading animation regardless of success/fail
    }
};

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

const removeExercise = (exIndex) => {
    const exercise = workoutExercises.value[exIndex]
    if (exercise?.id && typeof exercise.id === 'number') {
        deletedExerciseIds.value.push(exercise.id)
    }
    workoutExercises.value.splice(exIndex, 1)
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
.workout-card {
    transition: box-shadow 0.2s ease, border-color 0.2s ease;
    cursor: pointer;
}

.workout-card:hover {
    box-shadow: 0 4px 20px rgba(181, 232, 83, 0.15);
    border-color: rgba(181, 232, 83, 0.5);
}
</style>