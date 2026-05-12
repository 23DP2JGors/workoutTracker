import { createI18n } from 'vue-i18n'

import en from './locales/en.json'
import lv from './locales/lv.json'

// Load saved language or use English by default
const savedLocale = localStorage.getItem('locale') || 'en'

// Create global i18n instance
const i18n = createI18n({
    legacy: false,
    locale: savedLocale,
    fallbackLocale: 'en',
    messages: {
        en,
        lv,
    },
})

export default i18n