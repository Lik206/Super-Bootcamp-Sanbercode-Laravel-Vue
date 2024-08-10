<template>
    <button class="btn btn-sm btn-secondary" onclick="create_book.showModal()">Create Book</button>
    <dialog id="create_book" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form @submit.prevent="createBook()">
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input v-model="inputBook.title" type="text" class="grow" placeholder="title book" />
                </label>
                <label class="flex items-center gap-2 my-3">
                    <textarea v-model="inputBook.summary" placeholder="Summary"
                        class="textarea textarea-bordered textarea-lg w-full max-w-full"></textarea>
                </label>
                <label class="flex items-center gap-2 my-3">
                    <select v-model="inputBook.category_id" class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Choose Category</option>
                        <option :value="category.id" v-for="category in allCategory">{{ category.name }}</option>
                    </select>
                </label>
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input v-model="inputBook.stok" type="number" class="grow" placeholder="stok" />
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
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref, defineEmits, reactive } from 'vue';

const emit = defineEmits(['fetch-books'])

const authStore = useAuthStore()
const allCategory = ref([])
const inputBook = reactive({
    title: '',
    summary: '',
    image: '',
    stok: '',
    category_id: ''
})

const fetchCategory = async () => {
    try {
        const res = await CustomAPI.get('/category')
        allCategory.value = res.data.data
    } catch (error) {
        console.log(error);
    }
}

onMounted(() => {
    fetchCategory()
})

const getImage = (e) => {
    inputBook.image = e.target.files[0]
}

const createBook = async () => {
    try {
        let form = new FormData()

        form.append('title', inputBook.title)
        form.append('summary', inputBook.summary)
        form.append('image', inputBook.image)
        form.append('stok', inputBook.stok)
        form.append('category_id', inputBook.category_id)

        await CustomAPI.post('/book', form, {
            headers: { Authorization: `Bearer ${authStore.token}` }
        })

        emit('fetch-books')

        
    } catch (error) {
        console.log(error);
    }finally {
        inputBook.title = ''
        inputBook.summary = ''
        inputBook.image = ''
        inputBook.stok = ''
        inputBook.category_id = ''
    }
}


</script>