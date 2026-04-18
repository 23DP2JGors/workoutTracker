import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js'

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
    defaults: {
    VTextField: {
        variant: 'outlined',
        density: 'compact',
    },
    VBtn: {
        color: 'primary'
    }
    
},
    theme: {
        defaultTheme: 'dark',
        themes: {
            dark: {
                dark: true,
                colors: {
                    primary: '#B5E853',
                    background: '#121212',
                    subheading: '#64748B',
                    surface: '#1E1E1E',
                    secondary: '#03DAC6',
                    error: '#CF6679',
                    'on-background': '#E0E0E0',
                    'on-surface': '#E0E0E0',
                },
            },
            light: {
                dark: false,
                colors: {
                    primary: '#4CAF50',
                    subheading: '#94A3B8',
                    background: '#F5F5F5',
                    surface: '#FFFFFF',
                    'on-background': '#212121',
                    'on-surface': '#212121',
                },
            },
        },
    },
})

// Initialize the Vue application with Vuetify
createApp(App)
    .use(vuetify)
    .use(router)
    .mount('#app');
