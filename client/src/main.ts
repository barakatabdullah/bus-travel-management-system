import './styles/main.scss'
import 'virtual:uno.css'

import { createApp } from 'vue'
import PrimeVue from 'primevue/config'
import { createPinia } from 'pinia'
import { VueQueryPlugin } from '@tanstack/vue-query'
import App from './App.vue'
import { router } from './router'
import api from './config/axios'

// console.log(routes)

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(api)
app.use( VueQueryPlugin)
app.use(PrimeVue, { ripple: true })
app.mount('#app')
