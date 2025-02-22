// import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from "axios";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import App from './App.vue'
import router from './router'
import CanvasJSChart from '@canvasjs/vue-charts';

const app = createApp(App)

app.use(CanvasJSChart);
app.use(createPinia())
app.use(router)

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";
axios.defaults.withCredentials = true;
const token = localStorage.getItem("token");
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

app.mount('#appp')
