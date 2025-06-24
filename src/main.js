import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import api from './services/api';
import { useAuthStore } from './stores/auth';

const app = createApp(App);
app.use(createPinia());
app.use(router);

// Restore token on reload
const authStore = useAuthStore();
if (authStore.token) {
  api.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
}

app.mount('#app');
