<template>
  <div>
    <h1>Create Event</h1>
    <form @submit.prevent="createEvent">
      <input v-model="name" placeholder="Name" />
      <input v-model="date" type="datetime-local" />
      <input v-model="venue" placeholder="Venue" />
      <input v-model="totalTickets" type="number" placeholder="Total Tickets" />
      <input v-model="ticketPrice" type="number" placeholder="Price" />
      <button type="submit">Create</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import api from '../services/api';

const name = ref('');
const date = ref('');
const venue = ref('');
const totalTickets = ref(1);
const ticketPrice = ref(0);

const createEvent = async () => {
  await api.post('/events', {
    name: name.value,
    date: date.value,
    venue: venue.value,
    total_tickets: totalTickets.value,
    ticket_price: ticketPrice.value
  });
  alert('Event created!');
};
</script>
