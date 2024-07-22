<script setup>
import { ref } from 'vue';

const genres = ref([
    'Action',
    'Comedy',
    'Drama',
    'Fantasy',
    'Horror',
    'Mystery',
    'Romance',
    'Thriller',
]);
</script>
<template>
    <div v-motion :initial="{
        y: -100,
        opacity: 0
    }" :visible-once="{
        y: 0,
        opacity: 1,
        transition: { type: 'spring', stiffness: 20 }
    }">
        <div class="flex flex-wrap h-96 gap-5 items-center justify-center">
            <div v-for="(genre, index) in genres" :key="index"
                class="w-32 h-20 rounded-full bg-primary text-white flex justify-center items-center">
                <h1>{{ genre }}</h1>
            </div>
        </div>
    </div>
</template>