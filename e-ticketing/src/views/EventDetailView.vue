<template>
  <div v-if="event">
    <h1>{{ event.name }}</h1>
    <p>Venue: {{ event.venue }}</p>
    <p>Tickets Left: {{ event.available_tickets }}</p>
    <p>Price: ${{ event.ticket_price }}</p>

    <div v-if="auth.token">
      <input type="number" v-model="tickets" :max="event.available_tickets" min="1" />
      <button @click="bookTickets">Book Tickets</button>
    </div>
    <div v-else>
      <p>Please <router-link to="/login">Login</router-link> to book tickets</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../services/api';
import { useAuthStore } from '../stores/auth';

const route = useRoute();
const router = useRouter();
const event = ref(null);
const tickets = ref(1);
const auth = useAuthStore();

onMounted(async () => {
  const res = await api.get(`/events/${route.params.id}`);
  event.value = res.data;
});

const bookTickets = async () => {
  try {
    await api.post('/bookings', {
      event_id: event.value.id,
      number_of_tickets: tickets.value
    });
    alert('Booking successful!');
    router.push('/');
  } catch (err) {
    alert(err.response.data.message);
  }
};
</script>
