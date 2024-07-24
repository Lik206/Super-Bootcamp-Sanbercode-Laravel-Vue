import './assets/main.css'

import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { MotionPlugin } from '@vueuse/motion'


const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(router)
app.use(MotionPlugin)

pinia.use(({store}) => {
    store.router = markRaw(store)
})

app.mount('#app')
