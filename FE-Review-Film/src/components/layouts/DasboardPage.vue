<script setup lang="ts">
import FilmsPage from './FilmsPage.vue'
import DashboardMovie from '@/components/DashboardMovie.vue'
</script>

<template>
  <div class="flex flex-col w-full justify-center">
    <details class="collapse collapse-arrow bg-base-300">
      <summary class="collapse-title text-xl font-medium">Movie</summary>
      <div class="collapse-content grid">
        <button class="justify-self-end btn btn-primary text-end" onclick="my_modal_3.showModal()">
          Create
        </button>
        <DashboardMovie />
        <div class="bg-white/100 w-full h-full mt-5 rounded-md">
          <FilmsPage />
        </div>
      </div>
    </details>
  </div>
</template>
