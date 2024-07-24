<script setup>
import { useAuthStore } from '@/stores/AuthStore';
import { ref } from 'vue';

const authStore = useAuthStore()
const updateName = ref(null)
const handleUpdateUser = () => {
  authStore.updateUser(updateName)
}
</script>
<template>
  <div class="h-96 flex justify-center items-center">
    <div class="mockup-browser bg-base-300 border w-96 lg:w-1/2">
      <div class="mockup-browser-toolbar"></div>
      <div class="bg-base-200 px-4 py-16">
        <h1>Edit Profile</h1>
        <hr class="h-1 bg-gray-400 my-3"  />
        <label class="input input-bordered flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70"
        >
          <path
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
          />
        </svg>
        <input v-model="updateName" type="text" class="grow" placeholder="Username" />
      </label>
        <button @click="handleUpdateUser()" class="btn btn-secondary btn-sm w-24 mt-5">edit</button>
      </div>
    </div>
  </div>
</template>
