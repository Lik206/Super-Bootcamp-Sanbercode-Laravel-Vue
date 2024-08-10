<script setup>
import router from '@/router';
import { defineProps} from 'vue';

const detailBook = (inputId) => {
    router.push({ name: 'detailBook', params: { id: inputId } })
}


const props = defineProps({
    book: Object,
    required: true
})

</script>

<template>
    <div class="card card-compact bg-base-100 w-[230px] h-auto shadow-xl ">
        <div class="flex justify-center">
            <img :src="props.book.image" alt="" class="object-cover w-[auto] h-[200px]"/>
        </div>
        <div class="card-body">
            <h2 class="card-title">{{props.book.title}}</h2>
            <p>stok: {{props.book.stok}}</p>
            <div class="flex flex-wrap gap-2">
                <button class="btn btn-xs btn-secondary">{{ props.book.category.name}}</button>
            </div>
            <div class="card-actions justify-end">
                <button class="btn btn-primary btn-sm" @click="detailBook(props.book.id)">Detail</button>
            </div>
        </div>
    </div>
</template>
