<script setup>

import CardBook from '@/components/CardBook.vue'
import { defineProps } from 'vue';

const props = defineProps({
    books: Array,
    required: true,

}, {
    loading: Boolean,
    required: true
})
</script>
<template>
    <div v-if="props.loading">Loading...</div>
    <div v-else class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 place-items-center">
        <CardBook v-for="book in props.books" :book="book" />
        
    </div>
</template>