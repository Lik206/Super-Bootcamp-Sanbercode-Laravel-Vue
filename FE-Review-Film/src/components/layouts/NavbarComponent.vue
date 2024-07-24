<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import NavbarMobile from '@/components/NavbarMobile.vue'
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore()
const {logoutUser} = authStore

const handleLogout = () => {
    logoutUser()
}

const showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};

const motionProps = ref({
    initial: { opacity: 0, transform: 'translateX(-20px)' },
    visibleOnce: { opacity: 1, transform: 'translateX(0px)', transition: { duration: 300 } },
    leave: { opacity: 0, transform: 'translateX(-20px)', transition: { duration: 300 } },
});
</script>

<template>
    <div>
        <div class="navbar bg-base-100">
            <div class="flex-none">
                <button @click="toggleMenu" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">MyFilmList</a>
            </div>
            <div class="flex gap-3">
                <RouterLink v-if="!authStore.token" :to="{ name: 'login' }" active-class="font-bold">Login</RouterLink>
                <RouterLink v-if="!authStore.token" :to="{ name: 'register' }" active-class="font-bold">Register</RouterLink>
                <button @click="handleLogout" v-if="authStore.token" class="btn btn-secondary">Logout</button>
            </div>
        </div>
        <NavbarMobile v-motion="motionProps" v-if="showMenu" />
    </div>
</template>