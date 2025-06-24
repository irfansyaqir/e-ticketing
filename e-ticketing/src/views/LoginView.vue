<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <input v-model="email" placeholder="Email" />
      <input v-model="password" type="password" placeholder="Password" />
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const auth = useAuthStore();
const router = useRouter();

const login = async () => {
  try {
    await auth.login(email.value, password.value);
    router.push('/');
  } catch (err) {
    alert('Login failed');
  }
};
</script>
