<script setup>
import { ref } from 'vue';

const casts = ref([
    { img: 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSyJeCQUHv9EF_4rMiTd6g1JAxU9w5pXPp0dfWMg4_lZpaJo4pC' },
    { img: 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSyJeCQUHv9EF_4rMiTd6g1JAxU9w5pXPp0dfWMg4_lZpaJo4pC' },
    { img: 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSyJeCQUHv9EF_4rMiTd6g1JAxU9w5pXPp0dfWMg4_lZpaJo4pC' },
    { img: 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSyJeCQUHv9EF_4rMiTd6g1JAxU9w5pXPp0dfWMg4_lZpaJo4pC' },
])

</script>
<template>
    <div v-motion :initial="{
        y: -100,
        opacity: 0
    }" :visible-once="{
        y: 0,
        opacity: 1,
        transition: { type: 'spring', stiffness: 20 }
    }" class="flex flex-row flex-wrap gap-10 justify-around">
        <div class="w-28 rounded-full" v-for="(cast, index) in casts" :key="index">
            <img :src="cast.img" alt="" class="w-32 h-28 rounded-full object-cover object-top">
            <section class="text-center mt-3">
                <h1>lorem</h1>
                <p>Lorem, ipsum.</p>
            </section>
        </div>
    </div>
</template>