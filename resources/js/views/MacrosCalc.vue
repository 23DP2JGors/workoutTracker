<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="12" md="10" lg="8">
        <v-card variant="flat" class="rounded-xl border pa-6">
          <h1 class="font-weight-bold mb-1">
            {{ $t('macros.title') }}
          </h1>
           <div class="text-medium-emphasis text-body-2 pb-4">
            {{ $t('macros.subtitle') }}
          </div>

          <!-- Wrap inputs in v-form to track validation state -->
          <v-form v-model="isFormValid">
            <v-card-text class="px-0">
              <v-row>
                <v-col cols="12">
                  <div class="text-subtitle-2 mb-2">
                    {{ $t('macros.gender') }}
                  </div>
                  <v-btn-toggle v-model="form.gender" color="primary" rounded="lg" mandatory block @update:model-value="handleInputChange">
                    <v-btn value="male" class="flex-grow-1">
                      {{ $t('macros.male') }}
                    </v-btn>
                    <v-btn value="female" class="flex-grow-1">
                      {{ $t('macros.female') }}
                    </v-btn>
                  </v-btn-toggle>
                </v-col>

                <!-- Apply rules to text fields -->
                <v-col cols="12" sm="6" md="4">
                  <v-text-field
                    v-model="form.weight"
                    :label="$t('macros.weight')"
                    variant="outlined"
                    type="number"
                    hide-details="auto" 
                    :rules="[rules.required, rules.positiveNumber, rules.precision]"
                    @keydown="blockInvalidChars"
                    @input="() => { sanitizeWeight(); handleInputChange(); }"
                  ></v-text-field>
                </v-col>

                <!-- Height: whole numbers, max 3 digits, no negatives -->
                <v-col cols="12" sm="6" md="4">
                  <v-text-field
                    v-model="form.height"
                    :label="$t('macros.height')"
                    variant="outlined"
                    type="number"
                    hide-details="auto" 
                    :rules="[rules.required, rules.positiveNumber]"
                    @keydown="blockInvalidChars"
                    @input="() => { sanitizeInteger('height'); handleInputChange(); }"
                  ></v-text-field>
                </v-col>

                <!-- Age: whole numbers, max 3 digits, no negatives -->
                <v-col cols="12" sm="12" md="4">
                  <v-text-field
                    v-model="form.age"
                    :label="$t('macros.age')"
                    variant="outlined"
                    type="number"
                    hide-details="auto" 
                    :rules="[rules.required, rules.positiveNumber]"
                    @keydown="blockInvalidChars"
                    @input="() => { sanitizeInteger('age'); handleInputChange(); }"
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-select
                    v-model="form.activity_level"
                    :items="activityOptions"
                    :item-props="true"
                    item-value="value"
                    :label="$t('macros.activityLevel')"
                    variant="outlined"
                    hide-details="auto" 
                    :rules="[rules.required]"
                    @update:model-value="handleInputChange"
                  ></v-select>
                </v-col>

                <v-col cols="12">
                  <v-select
                    v-model="form.goal"
                    :items="goalOptions"
                    :item-props="true"
                    item-value="value"
                    :label="$t('macros.goal')"
                    variant="outlined"
                    hide-details="auto" 
                    :rules="[rules.required]"
                    @update:model-value="handleInputChange"
                  ></v-select>
                </v-col>
              </v-row>
            </v-card-text>
          </v-form>

          <!-- Results Section -->
          <v-expand-transition>
            <div v-if="showResult && result" class="mt-4">
              <v-divider class="mb-6"></v-divider>
              <div class="text-center mb-6">
                <div class="text-label-medium text-medium-emphasis text-uppercase">
                  {{ $t('macros.dailyTarget') }}
                </div>
                <div class="text-display-small font-weight-black text-primary">
                  {{ result.calories }}
                  <span class="text-title-large text-grey">{{ $t('macros.kcal') }}</span>
                </div>
              </div>
              <v-row dense>
                <v-col cols="4">
                  <v-card variant="flat" class="border rounded-xl text-center py-4">
                    <div class="text-caption text-grey text-uppercase">{{ $t('macros.protein') }}</div>
                    <div class="font-weight-bold">{{ result.protein }}g</div>
                  </v-card>
                </v-col>
                <v-col cols="4">
                  <v-card variant="flat" class="border rounded-xl text-center py-4">
                    <div class="text-caption text-grey text-uppercase">{{ $t('macros.fats') }}</div>
                    <div class="font-weight-bold">{{ result.fats }}g</div>
                  </v-card>
                </v-col>
                <v-col cols="4">
                  <v-card variant="flat" class="border rounded-xl text-center py-4">
                    <div class="text-caption text-grey text-uppercase">{{ $t('macros.carbs') }}</div>
                    <div class="font-weight-bold">{{ result.carbs }}g</div>
                  </v-card>
                </v-col>
              </v-row>
            </div>
          </v-expand-transition>

          <v-card-actions class="px-0 mt-4">
            <!-- Button is disabled if form is invalid -->
            <v-btn
              :disabled="!isFormValid"
              block
              color="primary"
              size="large"
              variant="flat"
              class="rounded-pill"
              @click="saveProfile"
            >
              {{ $t('macros.saveCalculate') }}
            </v-btn>
          </v-card-actions>

          <!-- Disclaimer -->
          <div class="text-caption text-grey-darken-1 text-center mt-4 font-italic text-label-medium">
            {{ $t('macros.disclaimer') }}
          </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- Single universal snackbar -->
    <v-snackbar v-model="snackbar" rounded="pill" :color="snackbarColor" :timeout="2000">
      {{ snackbarText }}
    </v-snackbar>
  </v-container>
</template>

<script setup>
import { reactive, onMounted, computed, ref} from 'vue'
import axios from 'axios'
import { rules } from '@/utils/rules' // validation rules
import { calculateMacros } from '@/utils/calculateMacros' // macros calculation logic
import { useI18n } from 'vue-i18n'

// Logic for showing success message
const isFormValid = ref(false)
const snackbar = ref(false)
const snackbarText = ref('')
const snackbarColor = ref('success')
const showResult = ref(false) // Control result visibility

// Provides translation function for macros page
const { t } = useI18n()

const saveError = ref(false) // New state for error snackbar

// Computed property to calculate macros based on form input
const result = computed(() => calculateMacros(form))

// Basic form state
const form = reactive({
  gender: 'male',
  weight: null,
  height: null,
  age: null,
  activity_level: 1.25,
  goal: 'maintenance'
})

const handleInputChange = () => {
  // Hide results if user changes any input after calculation
  if (showResult.value) {
    showResult.value = false
  }
}

// Function to block unwanted characters like +, -, e
const blockInvalidChars = (e) => {
    if (['e', 'E', '+', '-'].includes(e.key)) {
        e.preventDefault();
    }
};

// Advanced sanitization for weight (allows decimals)
const sanitizeWeight = () => {
    if (!form.weight) return;
    
    let val = form.weight.toString();
    
    // Remove everything except numbers and one dot
    val = val.replace(/[^0-9.]/g, '');
    
    // Ensure only one dot exists
    const parts = val.split('.');
    if (parts.length > 2) {
        val = parts[0] + '.' + parts.slice(1).join('');
    }

    // Limit decimals to 2 and total length before dot to 3
    if (val.includes('.')) {
        const [intPart, decimalPart] = val.split('.');
        val = `${intPart.slice(0, 3)}.${decimalPart.slice(0, 2)}`;
    } else {
        val = val.slice(0, 3);
    }
    
    form.weight = val;
};

// Simple sanitization for Age and Height (integers only)
const sanitizeInteger = (field) => {
    if (!form[field]) return;
    
    // Remove anything that isn't a digit and limit to 3 chars
    form[field] = form[field].toString().replace(/\D/g, '').slice(0, 3);
};


// Function to save profile data to the database
const saveProfile = async () => {
  try {
    // Send form data to backend API (adjust endpoint as needed)
    const response = await axios.post('/api/user-profile', form)
    
    // Success feedback
    snackbarText.value = t('macros.messages.saved')
    snackbarColor.value = 'success';
    snackbar.value = true;
    
    // Show the results block only after successful save
    showResult.value = true
    
  } catch (error) {
    // Show the exact error from Laravel in the UI
    if (error.response && error.response.status === 422) {
      // Get the first error message from Laravel's validation
      const errors = error.response.data.errors;
      const firstError = Object.values(errors)[0][0];
      snackbarText.value = firstError;
    } else {
        snackbarText.value = t('macros.messages.serverError');
    }
    snackbarColor.value = 'error';
    snackbar.value = true;
    showResult.value = false;
  }
}

// Activity options for the select input
const activityOptions = computed(() => [
  {
    title: t('macros.activity.sedentary.title'),
    subtitle: t('macros.activity.sedentary.subtitle'),
    value: 1.25,
  },
  {
    title: t('macros.activity.light.title'),
    subtitle: t('macros.activity.light.subtitle'),
    value: 1.3,
  },
  {
    title: t('macros.activity.moderate.title'),
    subtitle: t('macros.activity.moderate.subtitle'),
    value: 1.35,
  },
  {
    title: t('macros.activity.high.title'),
    subtitle: t('macros.activity.high.subtitle'),
    value: 1.375,
  },
  {
    title: t('macros.activity.veryHigh.title'),
    subtitle: t('macros.activity.veryHigh.subtitle'),
    value: 1.4,
  },
  {
    title: t('macros.activity.athlete.title'),
    subtitle: t('macros.activity.athlete.subtitle'),
    value: 1.45,
  },
])

// Goal options for the select input
const goalOptions = computed(() => [
  {
    title: t('macros.goals.maintenance.title'),
    subtitle: t('macros.goals.maintenance.subtitle'),
    value: 'maintenance',
  },
  {
    title: t('macros.goals.loss.title'),
    subtitle: t('macros.goals.loss.subtitle'),
    value: 'loss',
  },
  {
    title: t('macros.goals.gain.title'),
    subtitle: t('macros.goals.gain.subtitle'),
    value: 'gain',
  },
])

// Automatically fetch data when page loads
onMounted(async () => {
  try {
    const response = await axios.get('/api/user-profile')
    
    // If we have data, populate the form. If not, keep defaults for new users.
    if (response.data) {
      const data = response.data
      
      // Manually assign values with fallbacks to ensure form is always populated correctly
      form.gender = data.gender || 'male'
      form.weight = data.weight ? Number(data.weight) : null
      form.height = data.height ? Number(data.height) : null
      form.age = data.age ? Number(data.age) : null
      form.activity_level = data.activity_level ? Number(data.activity_level) : 1.25
      form.goal = data.goal || 'maintenance'

      // if new account with no weight, keep results hidden until user inputs data and saves
      if (form.weight) showResult.value = true
    }
  } catch (error) {
    snackbarText.value = t('macros.messages.loadError')
    snackbarColor.value = 'error'
    snackbar.value = true
  }
})

</script>
