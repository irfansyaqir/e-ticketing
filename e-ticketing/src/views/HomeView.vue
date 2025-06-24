<template>
  <div>
    <h1>Events</h1>
    <div v-for="event in events" :key="event.id">
      <h3>{{ event.name }}</h3>
      <p>Date: {{ event.date }}</p>
      <p>Venue: {{ event.venue }}</p>
      <p>Tickets Left: {{ event.available_tickets }}</p>
      <p>Price: ${{ event.ticket_price }}</p>
      <router-link :to="`/events/${event.id}`">View Details</router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';

const events = ref([]);

onMounted(async () => {
  const res = await api.get('/events');
  events.value = res.data;
});
</script>
