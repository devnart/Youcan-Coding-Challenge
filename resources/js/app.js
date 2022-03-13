require('./bootstrap');

import { createApp } from 'vue'
import App from './Pages/App.vue'

const app = createApp(App);

app.mount('#app')
