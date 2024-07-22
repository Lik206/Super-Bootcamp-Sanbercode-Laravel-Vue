<script setup>
import {RouterLink} from 'vue-router'
</script>
<template>
    <div class="bg-white h-screen w-full md:w-1/2">
        <div class="flex flex-col pl-5 gap-3 ">
            <RouterLink to="/" active-class="font-bold">Home</RouterLink>
            <RouterLink :to="{ name: 'verification' }" active-class="font-bold">verification</RouterLink>
            <RouterLink :to="{ name: 'film' }" active-class="font-bold">film</RouterLink>
            <RouterLink :to="{ name: 'genre' }" active-class="font-bold">genre</RouterLink>
            <RouterLink :to="{ name: 'cast' }" active-class="font-bold">cast</RouterLink>
        </div>
    </div>
</template>