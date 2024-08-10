<script setup>
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref } from 'vue';
import { RouterView, RouterLink } from 'vue-router'

const authStore = useAuthStore()

const isLogin = ref(false)
onMounted(() => {
    isLogin.value = authStore.login
})

const handleLogout = () => {
    authStore.logout()
    isLogin.value = false
}

</script>

<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="navbar bg-base-100 w-full">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="mx-2 flex-1 px-2 text-xl">
                    <RouterLink to="/">E-Perpus</RouterLink>
                </div>
                <div class="hidden flex-none lg:block">
                    <ul class="menu menu-horizontal flex items-center gap-3">
                        <!-- Navbar menu content here -->
                        <li v-if="authStore.role == 'owner'">
                            <RouterLink :to="{ name: 'dashboard' }">Dashboard</RouterLink>
                        </li>
                        <li v-if="authStore.token">
                            <RouterLink :to="{ name: 'profile' }">Profile</RouterLink>
                        </li>
                        <li v-if="!authStore.isLogin">
                            <RouterLink :to="{ name: 'login' }">Login</RouterLink>
                        </li>
                        <li v-if=!authStore.isLogin>
                            <RouterLink :to="{ name: 'register' }">Register</RouterLink>
                        </li>
                        <li v-if="authStore.isLogin" @click="handleLogout">
                            <button class="btn btn-sm">Logout</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Page content here -->
            <RouterView />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 min-h-full w-52 sm:w-80 p-4">
                <!-- Sidebar content here -->
                <li>
                    <RouterLink to="/">Home</RouterLink>
                </li>

                <li v-if="authStore.role == 'owner'">
                    <RouterLink :to="{ name: 'dashboard' }">Dashboard</RouterLink>
                </li>
                <li v-if="isLogin">
                    <RouterLink :to="{ name: 'profile' }">Profile</RouterLink>
                </li>
                <li class="font-bold" v-if="!isLogin">
                    <RouterLink :to="{ name: 'login' }">Login</RouterLink>
                </li>
                <li class="font-bold" v-if="!authStore.isLogin">
                    <RouterLink :to="{ name: 'register' }">Register</RouterLink>
                </li>
                <li class="font-bold" v-if="authStore.isLogin">
                    <button class="btn btn-sm bg-red-600 text-white" @click="authStore.logout">Logout</button>
                </li>
            </ul>
        </div>
    </div>
</template>