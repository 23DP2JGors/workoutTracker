<template>
    <v-btn
        variant="text"
        color="default"
        @click="toggleLocale"
    >
        {{ locale.toUpperCase() }}
    </v-btn>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

// Gets current language from global i18n
const { locale } = useI18n()

// Switches between English and Latvian
function toggleLocale() {
    locale.value = locale.value === 'en' ? 'lv' : 'en'
    localStorage.setItem('locale', locale.value)
}
</script>