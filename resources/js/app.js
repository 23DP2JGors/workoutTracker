import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';

// Vuetify setup
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Icon font setup
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import '@mdi/font/css/materialdesignicons.css'

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: { mdi },
    },
    theme: {
        defaultTheme: 'dark', // Set dark mode as default for that "sporty" look
        themes: {
            dark: {
                dark: true,
                colors: {
                    primary: '#CCFF00',    // Neon Lime for accents
                    background: '#121212', // Deep Dark Grey for background
                    surface: '#1E1E1E',    // Slightly lighter grey for cards
                    secondary: '#03DAC6',
                    error: '#CF6679',
                },
            },
            light: {
                dark: false,
                colors: {
                    primary: '#4CAF50',    // Calmer green for light mode
                    background: '#F5F5F5',
                    surface: '#FFFFFF',
                },
            },
        },
    },
})

// Initialize the Vue application with Vuetify
createApp(App)
    .use(vuetify)
    .mount('#app');
