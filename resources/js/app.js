import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js'
import i18n from './i18n'

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
    VSelect: {
            variant: 'outlined',
            density: 'compact',
            hideDetails: 'auto',
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
                    primary: '#7C86FF',
                    'on-primary': '#0A0C2E',
                    secondary: '#FFD23F',
                    'on-secondary': '#1A1400',
                    background: '#0B0D17',
                    surface: '#141829',
                    'surface-bright': '#1D2238',
                    'on-background': '#E9EBFA',
                    'on-surface': '#E9EBFA',
                    subheading: '#8E94B8',
                    success: '#3DDC97',
                    warning: '#FF9F43',
                    info: '#4CC9F0',
                    error: '#FF5C7A',
                },
            },
            light: {
                dark: false,
                colors: {
                    primary: '#4338CA',
                    'on-primary': '#FFFFFF',
                    secondary: '#FFC21A',
                    'on-secondary': '#1A1400',
                    background: '#F5F6FC',
                    surface: '#FFFFFF',
                    'surface-bright': '#ECEEFA',
                    'on-background': '#11132B',
                    'on-surface': '#11132B',
                    subheading: '#5A5F85',
                    success: '#0F7B55',
                    warning: '#B45309',
                    info: '#0B6FB8',
                    error: '#C92A48',
                },
            },
        },
    },
})

// Initialize the Vue application with Vuetify
createApp(App)
    .use(vuetify)
    .use(router)
    .use(i18n)
    .mount('#app');
