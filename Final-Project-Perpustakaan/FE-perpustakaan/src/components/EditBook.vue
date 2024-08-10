<template>
    <button class="btn btn-sm btn-primary" @click="show">edit</button>
    <dialog :id="`edit_book-${index}`" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form @submit.prevent="editBook()">
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input v-model="inputBook.title" type="text" class="grow" />
                </label>
                <label class="flex items-center gap-2 my-3">
                    <textarea v-model="inputBook.summary"
                        class="textarea textarea-bordered textarea-lg w-full max-w-full"></textarea>
                </label>
                <label class="flex items-center gap-2 my-3">
                    <select v-model="inputBook.category_id" class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Choose Category</option>
                        <option :value="category.id" v-for="category in allCategory">{{ category.name }}</option>

                    </select>
                </label>
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input type="number" class="grow" v-model="inputBook.stok" />
                </label>
                <label class="flex items-center gap-2 my-3">
                    <input @change="getImage" type="file" class="file-input file-input-bordered w-full max-w-xs" />
                </label>
                <input type="submit" value="submit" class="btn btn-primary" />
            </form>
        </div>
    </dialog>
</template>
<script setup>
import { defineProps, reactive, onMounted, ref, defineEmits } from 'vue';
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import axios from 'axios';

const authStore = useAuthStore()

const emit = defineEmits(['fetch-books'])

const props = defineProps({
    index: {
        type: Number,
        required: true,
    },
    book: {
        type: Object,
        required: true
    }

})

const show = () => {
    const dialog = document.getElementById(`edit_book-${props.index}`);

    dialog.showModal()
}


const allCategory = ref([])

const fetchCategory = async () => {
    try {
        const res = await CustomAPI.get('/category')
        allCategory.value = res.data.data
    } catch (error) {
        console.log(error);
    }
}


const inputBook = ref({
    image: null, // This will hold the File object
    title: props.book.title,
    summary: props.book.summary,
    stok: props.book.stok,
    category_id: props.book.category_id
});


const getImage = (e) => {
    if (e.target.files) {
        inputBook.value.image = e.target.files[0]
    }
}

const editBook = async () => {
    try {
        let form = new FormData()

        form.append('title', inputBook.value.title)
        form.append('summary', inputBook.value.summary)
        form.append('image', inputBook.value.image)
        form.append('stok', inputBook.value.stok)
        form.append('category_id', inputBook.value.category_id)

        await CustomAPI.post(`/book/${props.book.id}?_method=put`, form, {
            headers: { Authorization: `Bearer ${authStore.token}` }
        })
        console.log(inputBook.image);

        emit('fetch-books')
        console.log('success');

    } catch (error) {
        console.log(error);
    } finally {
        inputBook.value.title = ''
        inputBook.value.summary = ''
        inputBook.value.image = ''
        inputBook.value.stok = ''
        inputBook.value.category_id = ''
    }
}


onMounted(async () => {
    fetchCategory()
})
</script>