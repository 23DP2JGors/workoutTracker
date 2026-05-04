<template>
  <v-container class="py-8">
    <v-row justify="center">
      <v-col cols="12" md="8">
        <v-card variant="flat" rounded="xl" class="pa-6 border">
          <h1 class="font-weight-bold mb-1">Body Measurements</h1>
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

    <v-row justify="center">
      <v-col cols="12" md="8">

        <!-- Measurement History Section -->
        <v-card variant="flat" rounded="xl" class="pa-6 border mt-6">
            <h2 class="font-weight-bold mb-1">History</h2>
            <p class="text-medium-emphasis text-body-2 pb-4">View and manage your past entries</p>

            <!-- Highlight Filters (Top selection chips) -->
            <div class="mb-6">
                <div class="text-caption text-grey mb-2 font-weight-bold text-uppercase">
                    Filter by body part
                </div>
                <v-chip-group
                    v-model="historyFilters"
                    column
                    multiple
                    selected-class="text-primary"
                >
                    <v-chip
                        v-for="part in bodyParts"
                        :key="part.key"
                        :value="part.key"
                        variant="outlined"
                        size="small"
                        rounded="lg"
                        filter
                    >
                        {{ part.label }}
                    </v-chip>
                </v-chip-group>
            </div>

            <!-- Scrollable List of Logs -->
            <div style="max-height: 600px; overflow-y: auto;" class="pr-2">
                
                <!-- Empty state alert -->
                <v-alert v-if="!filteredMeasurements.length" type="info" variant="tonal" rounded="lg">
                    No measurements recorded yet.
                </v-alert>

                <!-- Main Loop for history entries -->
                <v-card
                    v-for="m in filteredMeasurements"
                    :key="m.id"
                    variant="outlined"
                    rounded="xl"
                    class="pa-4 mb-4 border"
                >
                    <v-row align="center">
                        <!-- Log Data Column -->
                        <v-col cols="12" sm="8">
                            <div class="font-weight-bold mb-3 text-primary">
                                {{ formatDate(m.measured_at) }}
                            </div>
                            
                            <div class="d-flex flex-wrap">
                                <!-- Dynamic rendering of recorded body parts with highlighting -->
                                <template v-for="part in bodyParts" :key="part.key">
                                    <v-chip
                                        v-if="m[part.key] !== null && m[part.key] !== undefined"
                                        size="small"
                                        class="mr-2 mb-2 text-caption"
                                        :color="historyFilters.includes(part.key) ? 'primary' : 'default'"
                                        :variant="historyFilters.includes(part.key) ? 'flat' : 'outlined'"
                                        :class="{ 'font-weight-black': historyFilters.includes(part.key) }"
                                    >
                                        {{ part.label }} {{ formatNum(m[part.key]) }} {{ part.unit }}
                                    </v-chip>
                                </template>
                            </div>

                            <!-- Display notes if they exist -->
                            <p v-if="m.notes" class="text-caption text-medium-emphasis mt-2 font-italic">
                                "{{ m.notes }}"
                            </p>
                        </v-col>

                        <!-- Action Buttons Column -->
                        <v-col cols="12" sm="4" class="d-flex justify-end align-center">
                            <v-btn 
                                icon="mdi-pencil-outline" 
                                variant="text" 
                                size="small" 
                                color="primary" 
                                class="mr-2"
                                @click="openEdit(m)"
                            ></v-btn>
                            <v-btn 
                                icon="mdi-delete-outline" 
                                variant="text" 
                                size="small" 
                                color="error" 
                                @click="deleteMeasurement(m.id)"
                            ></v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- Edit Dialog -->
    <v-dialog v-model="editDialog" max-width="500">
      <v-card rounded="xl" class="pa-6">
          <h2 class="font-weight-bold mb-1">Edit Measurement</h2>
          <p class="text-medium-emphasis text-body-2 pb-6">Update your recorded data</p>

          <v-row>
              <v-col cols="12">
                  <v-text-field
                      v-model="editForm.measured_at"
                      label="Date"
                      type="date"
                      variant="outlined"
                      rounded="lg"
                  ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" v-for="key in editableFields" :key="key">
                  <v-text-field
                      v-if="editForm[key] !== null && editForm[key] !== undefined"
                      v-model="editForm[key]"
                      :label="getLabel(key) || 'Weight (kg)'"
                      type="number"
                      variant="outlined"
                      rounded="lg"
                      @paste.prevent
                      @keydown="blockInvalidChars"
                  ></v-text-field>
              </v-col>
              <v-col cols="12">
                  <v-textarea
                      v-model="editForm.notes"
                      label="Notes"
                      variant="outlined"
                      rounded="lg"
                      rows="2"
                  ></v-textarea>
              </v-col>
          </v-row>

          <div class="d-flex justify-space-between mt-2">
              <v-btn variant="text" @click="editDialog = false">Cancel</v-btn>
              <v-btn color="primary" rounded="lg" @click="updateMeasurement">Save</v-btn>
          </div>
      </v-card>
    </v-dialog>
    <!-- Global Snackbar Notification -->
    <v-snackbar
        v-model="snackbar"
        :color="snackbarColor"
        rounded="pill"
        :timeout="2000"
    >
        <div class="text-center">
            {{ snackbarText }}
        </div>
    </v-snackbar>
  </v-container>
</template>

<script setup>
import { ref, reactive, onMounted, computed, watch } from 'vue';
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

// History
const measurements = ref([])
const editDialog = ref(false)
const editForm = ref({})
const editableFields = ['weight', 'neck', 'chest', 'biceps', 'forearms', 'waist', 'hips', 'calves']

// Variable to store selected filters for history
const historyFilters = ref([]); 


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

// Computed property to filter measurements based on selected body parts
const filteredMeasurements = computed(() => {
    // If no filters selected, show everything
    if (historyFilters.value.length === 0) return measurements.value;

    return measurements.value.filter(log => {
        // Check if the log has at least one of the selected body parts filled
        return historyFilters.value.some(filterKey => {
            return log[filterKey] !== null && log[filterKey] !== undefined;
        });
    });
});

// Watch for changes in history filters to provide feedback if no data exists for selected parts
watch(historyFilters, (newFilters) => {
    if (newFilters.length === 0) return;

    // Get the last selected filter
    const lastFilter = newFilters[newFilters.length - 1];
    
    // Check if any log in history contains this measurement
    const exists = measurements.value.some(log => log[lastFilter] !== null && log[lastFilter] !== undefined);

    if (!exists) {
        // Show snackbar if no data found for this body part
        const part = bodyParts.find(p => p.key === lastFilter);
        snackbarText.value = `No data found for ${part?.label} in your history yet.`;
        snackbarColor.value = 'info';
        snackbar.value = true;
    }
}, { deep: true });

// Helper to show snackbar with custom message and color
const showMessage = (text, color = 'success') => {
    snackbarText.value = text;
    snackbarColor.value = color;
    snackbar.value = true;
};


// Handle clicking on a body part card
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
        await loadMeasurements()
         showMessage('Measurement recorded successfully!'); // Success UI

        // Reset selection and weight/notes
        selectedParts.value = [];
        form.weight = null;
        form.notes = '';
        
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
            showMessage('Please check the highlighted fields', 'error'); // Validation UI
        }else{
            showMessage('An error occurred while saving. Please try again.', 'error'); // General error UI
        }
    } finally {
        loading.value = false;
    }
};

// Format date for display in history
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-GB', {
        day: 'numeric', month: 'long', year: 'numeric'
    })
}

const formatNum = (val) => {
    if (val === null || val === undefined) return null
    return Number(val) % 1 === 0 ? parseInt(val) : parseFloat(val)
}

// Open edit dialog with selected measurement data
const openEdit = (m) => {
    editForm.value = { 
        ...m,
        measured_at: m.measured_at.split('T')[0],
        weight: formatNum(m.weight),
        neck: formatNum(m.neck),
        chest: formatNum(m.chest),
        biceps: formatNum(m.biceps),
        forearms: formatNum(m.forearms),
        waist: formatNum(m.waist),
        hips: formatNum(m.hips),
        calves: formatNum(m.calves),
    }
    editDialog.value = true
}

// Send updated data to API
const updateMeasurement = async () => {
    try {
        await axios.put(`/api/measurements/${editForm.value.id}`, editForm.value)
        await loadMeasurements()
        editDialog.value = false
        showMessage('Entry updated!');
    } catch (error) {
        showMessage('Failed to update entry', 'error');
    }
}

// Delete measurement
const deleteMeasurement = async (id) => {
    try {
        await axios.delete(`/api/measurements/${id}`)
        await loadMeasurements()
        showMessage('Entry deleted', 'warning'); // Use warning color for deletion
    } catch (error) {
        showMessage('Failed to delete entry', 'error');
    }
}

// Load measurements history from API
const loadMeasurements = async () => {
    const res = await axios.get('/api/measurements')
    measurements.value = res.data
}

// Load history on component mount
onMounted(async () => {
    await loadMeasurements()
})
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

.measurement-card {
    transition: border-color 0.2s ease;
}
.measurement-card:hover {
    border-color: rgba(181, 232, 83, 0.4);
}
</style>