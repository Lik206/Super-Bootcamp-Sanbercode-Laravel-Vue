<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const routes = ref([
  { name: 'home', title: 'Home' },
  { name: 'about', title: 'About' },
  { name: 'portfolio', title: 'Portfolio' },
  { name: 'experience', title: 'Experience' }
])
</script>

<template>
  <div class="sm:container sm:mx-auto">
    <nav class="navbar bg-base-100 sm:rounded-2xl">
      <div class="flex-1">
        <a class="btn btn-ghost text-xl">MyCV</a>
      </div>

      <div class="flex gap-3">
        <div class="flex-2" v-for="(route, index) in routes" :key="index">
          <RouterLink :to="{ name: route.name }" active-class="btn btn-ghost text-sm p-2" exact-active-class="btn btn-ghost text-sm bg-gray-300 p-2">{{ route.title }}</RouterLink >
        </div>
      </div>
    </nav>
  </div>
</template>
<style></style>
