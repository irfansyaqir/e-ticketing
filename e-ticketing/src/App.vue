<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/bookings">My Bookings</router-link> |
      <router-link to="/create-event">Create Event</router-link> |
      <router-link to="/login">Login</router-link>
    </nav>
    <router-view />
  </div>
</template>
