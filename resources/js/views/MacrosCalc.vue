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
              <!-- Gender selection using Button Toggle for better UX -->
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
                  label="Activity Level"
                  variant="outlined"
                  class="mt-2"
                >
                  <!-- Custom slot to show titles with subtitles -->
                  <template v-slot:item="{ props, item }">
                    <v-list-item 
                      v-bind="props" 
                      :subtitle="item.raw.subtitle"
                    ></v-list-item>
                  </template>
                </v-select>
              </v-col>
            </v-row>
          </v-card-text>

          <v-card-actions class="px-0 mt-4">
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
  activity_level: 'sedentary',
  goal: 'maintenance'
})

// Activity options for the select input
const activityOptions = [
  { title: 'Sedentary (Office job)', value: 'sedentary' },
  { title: 'Lightly Active', value: 'lightly_active' },
  { title: 'Moderately Active', value: 'moderately_active' },
  { title: 'Very Active', value: 'very_active' }
]

const saveProfile = () => {
  console.log('Saving...', form)
  // We will add Axios call here in the next step
}
</script>
