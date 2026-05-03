<template>
  <v-container class="py-8">
    <v-row justify="center">
      <v-col cols="12" md="8">
        <v-card variant="flat" rounded="xl" class="pa-6 border">

          <!-- Header inside card like Macros -->
          <h1 class="text-h5 font-weight-bold mb-1">Body Measurements</h1>
          <p class="text-medium-emphasis text-body-2 pb-6">Track your body composition over time</p>

          <!-- Selection Grid -->
          <p class="text-body-2 text-medium-emphasis text-uppercase font-weight-bold pb-3">
            Select measurements
          </p>
          <v-row dense class="mb-2">
            <v-col v-for="item in bodyParts" :key="item.key" cols="4" sm="3" md="2">
              <v-card
                :color="selectedParts.includes(item.key) ? 'primary' : undefined"
                :variant="selectedParts.includes(item.key) ? 'flat' : 'outlined'"
                rounded="lg"
                class="text-center py-3 body-part-card cursor-pointer"
                @click="togglePart(item.key)"
              >
                <v-icon 
                  size="24" 
                  :icon="item.icon"
                  :color="selectedParts.includes(item.key) ? 'black' : 'default'"
                ></v-icon>
                <div class="text-caption mt-1 font-weight-medium">{{ item.label }}</div>
              </v-card>
            </v-col>
          </v-row>

          <v-divider class="my-6"></v-divider>

          <!-- Form -->
          <v-form 
            v-if="selectedParts.length > 0 || form.weight" 
            ref="formRef" 
            @submit.prevent="submitMeasurement"
          >
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field 
                  v-model="form.measured_at" 
                  label="Date" 
                  type="date" 
                  variant="outlined"
                  rounded="lg"
                  :error-messages="errors.measured_at"
                ></v-text-field>
              </v-col>
              <v-col v-for="key in selectedParts" :key="key" cols="12" sm="6" md="4">
                <v-text-field 
                  v-model="form[key]" 
                  :label="getLabel(key)"
                  type="number" 
                  variant="outlined"
                  rounded="lg"
                  :append-inner-icon="key === 'weight' ? 'mdi-scale' : 'mdi-ruler'"
                  :error-messages="errors[key]"
                  :rules="[rules.required]"
                  @paste.prevent
                  @keydown="blockInvalidChars"
                  @input="sanitizeField(key, 3, 1)"
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-textarea
                  v-model="form.notes"
                  label="Notes & Observations"
                  variant="outlined"
                  rounded="lg"
                  rows="2"
                  counter="200"
                  maxlength="200"
                  persistent-counter
                  :error-messages="errors.notes"
                ></v-textarea>
              </v-col>
            </v-row>

            <v-btn 
              block 
              color="primary" 
              size="large" 
              type="submit" 
              rounded="pill"
              class="mt-2"
              :loading="loading"
            >
              Save Measurements
            </v-btn>
          </v-form>

          <v-alert v-else type="info" variant="tonal" rounded="lg" class="mt-2">
            Select body parts above to start logging your progress.
          </v-alert>

        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import { rules } from '@/utils/rules';

const loading = ref(false);
const formRef = ref(null);
const errors = ref({});
const selectedParts = ref([]); // Stores active keys, e.g., ['biceps', 'waist']
// Snackbar state for feedback
const snackbar = ref(false);
const snackbarText = ref('');
const snackbarColor = ref('success');


// Define icons and labels for our clickable cards
const bodyParts = [
    { key: 'weight', label: 'Weight', icon: 'mdi-scale-bathroom', unit: 'kg' },
    { key: 'neck', label: 'Neck', icon: 'mdi-variable', unit: 'cm' },
    { key: 'chest', label: 'Chest', icon: 'mdi-human-male-height', unit: 'cm' },
    { key: 'biceps', label: 'Biceps', icon: 'mdi-arm-flex', unit: 'cm' },
    { key: 'forearms', label: 'Forearms', icon: 'mdi-arm-flex-outline', unit: 'cm' },
    { key: 'waist', label: 'Waist', icon: 'mdi-human-capacity-increase', unit: 'cm' },
    { key: 'hips', label: 'Hips', icon: 'mdi-human-handsdown', unit: 'cm' },
    { key: 'calves', label: 'Calves', icon: 'mdi-run', unit: 'cm' },
];

const form = reactive({
    measured_at: new Date().toISOString().substr(0, 10),
    weight: null,
    neck: null,
    chest: null,
    biceps: null,
    forearms: null,
    waist: null,
    hips: null,
    calves: null,
    notes: ''
});

// --- Logic Methods ---

/**
 * Handle clicking on a body part card
 */
const togglePart = (key) => {
    const index = selectedParts.value.indexOf(key);
    if (index > -1) {
        // If already selected, remove it and clear the value
        selectedParts.value.splice(index, 1);
        form[key] = null;
    } else {
        // If not selected, add to the list
        selectedParts.value.push(key);
    }
};

/**
 * Helper to get the display label for the input fields
 */
const getLabel = (key) => {
    const part = bodyParts.find(p => p.key === key);
    return part ? `${part.label} (${part.unit})` : '';
};

/**
 * Block unwanted math symbols in number inputs
 */
const blockInvalidChars = (e) => {
    if (['e', 'E', '+', '-'].includes(e.key)) e.preventDefault();
};

/**
 * Sanitize input to allow only 3 digits before dot and 1 after
 */
const sanitizeField = (field, maxInt = 3, maxDec = 1) => {
    if (form[field] === null || form[field] === undefined) return
    
    // Remove everything except digits and one dot
    let val = String(form[field]).replace(/[^0-9.]/g, '')
    
    // Allow only one dot
    const dotIndex = val.indexOf('.')
    if (dotIndex !== -1) {
        val = val.slice(0, dotIndex + 1) + val.slice(dotIndex + 1).replace(/\./g, '')
    }
    
    // Limit integer and decimal parts
    const [intPart = '', decPart] = val.split('.')
    const trimmedInt = intPart.slice(0, maxInt)
    
    if (decPart !== undefined) {
        val = `${trimmedInt}.${decPart.slice(0, maxDec)}`
    } else {
        val = trimmedInt
    }
    
    form[field] = val
}

/**
 * Send data to Laravel API
 */
const submitMeasurement = async () => {
    const { valid } = await formRef.value.validate()
    if (!valid) return
    
    loading.value = true;
    errors.value = {};

    try {
        await axios.post('/api/measurements', form);
        alert('Measurement saved!');
        
        // Optional: Reset form and selection after success
        // selectedParts.value = [];
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
        }
    } finally {
        loading.value = false;
    }
};
</script>

<style scoped>
/* transition on body part cards */
.body-part-card {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.body-part-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(181, 232, 83, 0.2);
}
</style>