<script setup>
import ProfilePage from '@/components/layouts/ProfilePage.vue'
import { useAuthStore } from '@/stores/AuthStore';
// import { onMounted } from 'vue';

const authStore = useAuthStore()
authStore.getMe()
</script>
<template>
<ProfilePage />
</template>