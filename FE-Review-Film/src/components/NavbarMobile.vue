<script setup>
import {RouterLink} from 'vue-router'
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore()

</script>
<template>
    <div class="bg-white h-screen w-full md:w-1/2">
        <div class="flex flex-col pl-5 gap-3 ">
            <RouterLink to="/" active-class="font-bold">Home</RouterLink>
            <RouterLink v-if="authStore.user || authStore.user.roles.name === 'admin'" :to="{ name: 'dashboard' }" active-class="font-bold">Dashboard</RouterLink>
            <RouterLink :to="{ name: 'film' }" active-class="font-bold">film</RouterLink>
            <RouterLink :to="{ name: 'genre' }" active-class="font-bold">genre</RouterLink>
            <RouterLink :to="{ name: 'cast' }" active-class="font-bold">cast</RouterLink>
            <RouterLink v-if='authStore.token' :to="{ name: 'profile' }" active-class="font-bold">profile</RouterLink>
        </div>
    </div>
</template>