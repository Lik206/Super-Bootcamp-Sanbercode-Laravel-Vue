<script setup>
import { RouterView } from 'vue-router'
import NavbarComponent from './components/NavbarComponent.vue'
</script>

<template>
  <div class="bg-gradient-to-r from-teal-100 to-blue-500">
    <NavbarComponent class="md:p-5" />
    <RouterView />
  </div>
</template>

<style scoped></style>
