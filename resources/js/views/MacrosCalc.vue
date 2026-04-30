<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="12" md="10" lg="8">
        <!-- Main Card with "Apple-style" flat border -->
        <v-card variant="flat" class="rounded-xl border pa-6">
          <v-card-title class="text-h5 font-weight-bold px-0">
            Macros Calculator
          </v-card-title>
          <v-card-subtitle class="px-0">
            Enter your metrics to calculate daily requirements
          </v-card-subtitle>

          <v-card-text class="mt-6 px-0">
            <v-row>
              <!-- Gender selection using Button Toggle -->
              <v-col cols="12">
                <div class="text-subtitle-2 mb-2">Gender</div>
                <v-btn-toggle
                  v-model="form.gender"
                  color="primary"
                  rounded="lg"
                  mandatory
                  block
                >
                  <v-btn value="male" class="flex-grow-1">Male</v-btn>
                  <v-btn value="female" class="flex-grow-1">Female</v-btn>
                </v-btn-toggle>
              </v-col>

              <!-- Metrics with Adaptive Grid: 1 per row on mobile, 2 on tablets/small laptops, 3 on large screens -->
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model.number="form.weight"
                  label="Weight (kg)"
                  variant="outlined"
                  type="number"
                  hide-details="auto"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model.number="form.height"
                  label="Height (cm)"
                  variant="outlined"
                  type="number"
                  hide-details="auto"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12" md="4">
                <v-text-field
                  v-model.number="form.age"
                  label="Age"
                  variant="outlined"
                  type="number"
                  hide-details="auto"
                ></v-text-field>
              </v-col>

              <!-- Activity Level with detailed subtitles in the dropdown -->
              <v-col cols="12">
                <v-select
                  v-model="form.activity_level"
                  :items="activityOptions"
                  :item-props="true"
                  item-value="value"
                  label="Activity Level"
                  class="mt-2"
                ></v-select>
              </v-col>
              <!-- Goal Selection -->
              <v-col cols="12">
                <v-select
                  v-model="form.goal"
                  :items="goalOptions"
                  :item-props="true"
                  item-value="value"
                  label="Your Goal"
                  class="mt-2"
                ></v-select>
              </v-col>
            </v-row>
          </v-card-text>

          <v-card-actions class="px-0">
            <v-btn
              block
              color="primary"
              size="large"
              variant="flat"
              class="rounded-pill"
              @click="saveProfile"
            >
              Save & Calculate
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { reactive } from 'vue'

// Basic form state
const form = reactive({
  gender: 'male',
  weight: null,
  height: null,
  age: null,
  activity_level: 1.25,
  goal: 'maintenance'
})

// Activity options for the select input
const activityOptions = [
  { 
    title: '[1.25] Sedentary', 
    subtitle: 'Office job, walking < 1h, or 1 light workout',
    value: 1.25 
  },
  { 
    title: '[1.3] Light Activity', 
    subtitle: '2-3 low-intensity workouts (yoga, dancing, pool)',
    value: 1.3 
  },
  { 
    title: '[1.35] Moderate Activity', 
    subtitle: '2-3 moderate workouts (gym, fitness, cardio)',
    value: 1.35 
  },
  { 
    title: '[1.375] High Activity', 
    subtitle: 'Stable 3+ intense workouts per week (50 min+)',
    value: 1.375 
  },
  { 
    title: '[1.4] Very High Activity', 
    subtitle: '4-5 high-intensity workouts per week',
    value: 1.4 
  },
  { 
    title: '[1.45] Athlete / Pro', 
    subtitle: '5+ intense workouts per week or daily training',
    value: 1.45 
  }
]

const goalOptions = [
  { 
    title: 'Maintenance', 
    subtitle: 'Keep your current weight and stay fit',
    value: 'maintenance' 
  },
  { 
    title: 'Weight Loss', 
    subtitle: 'Burn fat with a safe calorie deficit',
    value: 'loss' 
  },
  { 
    title: 'Muscle Gain', 
    subtitle: 'Build muscle with a slight calorie surplus',
    value: 'gain' 
  }
]



const saveProfile = () => {
  console.log('Saving...', form)
  // We will add Axios call here in the next step
}
</script>
