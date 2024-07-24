<script setup>
import { useAuthStore } from '@/stores/AuthStore'
import { RouterLink } from 'vue-router'

const authStore = useAuthStore()
authStore.getMe()
const { name, email } = authStore.user
</script>
<template>
  <div
    v-motion
    :initial="{
      y: -100,
      opacity: 0
    }"
    :visible-once="{
      y: 0,
      opacity: 1,
      transition: { type: 'spring', stiffness: 20 }
    }"
    class="h-96 flex justify-center items-center"
  >
    <div class="mockup-browser bg-base-300 border w-96 lg:w-1/2">
      <div class="mockup-browser-toolbar"></div>
      <div class="bg-base-200 px-4 py-16">
        <h1>Profile</h1>
        <hr class="h-1 bg-gray-400" />
        <h2 class="mt-5">
          Username: <span class="inline-block ml-8">{{ name }}</span>
        </h2>
        <h2>
          email: <span class="inline-block ml-16">{{ email }}</span>
        </h2>

        <router-link to="profile/edit">
          <button class="btn btn-secondary btn-sm w-24 mt-5">edit</button>
        </router-link>
      </div>
    </div>
  </div>
</template>
