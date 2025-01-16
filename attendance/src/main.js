// import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from "axios";

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(router)
axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

app.mount('#appp')
