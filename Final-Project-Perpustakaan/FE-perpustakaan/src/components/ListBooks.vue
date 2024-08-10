<script setup>
import { onMounted, ref } from 'vue';
import CreateBook from './CreateBook.vue';
import EditBook from './EditBook.vue';
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore()
const allBook = ref([])
const loading = ref(false)

const fetchBooks = async () => {
    loading.value = true
    try {
        const res = await CustomAPI.get('/book')

        allBook.value = res.data.data
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
}


onMounted(() => {
    fetchBooks()
})

const deleteBook = async (id) => {
    try {
        await CustomAPI.post(`/book/${id}?_method=delete`, {}, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchBooks()
    } catch (error) {
        console.log(error);
    }
}

</script>

<template>
    <h2>All Book</h2>
    <div class="my-2">
        <CreateBook @fetch-books="fetchBooks" />
    </div>
    <div class="overflow-x-auto">
        <div v-if="loading">Loading...</div>
        <table v-else class="table border-collapse border border-slate-500">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Stok</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr v-for="(data, index) in allBook">
                    <th>{{ index + 1 }}</th>
                    <td>{{ data.title }}</td>
                    <td>{{ data.category.name }}</td>
                    <td>{{ data.stok }}</td>
                    <td>
                        <img :src="data.image" class="w-12 h-12 object-contain" alt="">
                    </td>
                    <td>
                        <div class="flex justify-around gap-3">
                            <EditBook :index="index" :book="data" @fetch-books="fetchBooks" />
                            <button @click="deleteBook(data.id)" class="btn btn-sm bg-red-600 text-white">delete</button>
                        </div>
                    </td>
                </tr>
                <!-- row 2 -->

            </tbody>
        </table>
    </div>
</template>