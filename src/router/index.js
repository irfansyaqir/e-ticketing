import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import EventDetailView from '../views/EventDetailView.vue';
import MyBookingsView from '../views/MyBookingsView.vue';
import OrganizerCreateEvent from '../views/OrganizerCreateEvent.vue';
import LoginView from '../views/LoginView.vue';

const routes = [
  { path: '/', component: HomeView },
  { path: '/login', component: LoginView },
  { path: '/events/:id', component: EventDetailView },
  { path: '/bookings', component: MyBookingsView },
  { path: '/create-event', component: OrganizerCreateEvent }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
