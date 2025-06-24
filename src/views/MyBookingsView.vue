<template>
  <div>
    <h1>My Bookings</h1>
    <div v-for="b in bookings" :key="b.id">
      <h3>{{ b.event.name }}</h3>
      <p>Tickets: {{ b.number_of_tickets }}</p>
      <p>Total: ${{ b.total_price }}</p>
      <button @click="cancelBooking(b.id)">Cancel</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';

const bookings = ref([]);

onMounted(async () => {
  const res = await api.get('/bookings');
  bookings.value = res.data;
});

const cancelBooking = async (id) => {
  await api.delete(`/bookings/${id}`);
  bookings.value = bookings.value.filter(b => b.id !== id);
};
</script>
