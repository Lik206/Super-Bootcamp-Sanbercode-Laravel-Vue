<script setup>
import { CustomAPI } from '@/api';
import Books from '@/components/Books.vue'
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref, computed } from 'vue';

const allCategory = ref([])
const loading = ref(false)
const books = ref([])
const searchQuery = ref('')
const activeCategory = ref(null)
const authStore = useAuthStore()

const fetchCategory = async () => {
    try {
        const res = await CustomAPI.get('/category')
        allCategory.value = res.data.data
    } catch (error) {
        console.log(error);
    }
}

const filterBooksByCategory = async (id) => {
    try {
        const res = await CustomAPI.get(`/category/${id}`)
        books.value = res.data.data.list_books
        activeCategory.value = res.data.data.id
    } catch (error) {
        console.log(error);
    }
}

const fetchBooks = async () => {
    loading.value = true
    try {
        const res = await CustomAPI.get('/book')

        books.value = res.data.data
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
    activeCategory.value = null
    searchQuery.value = ''
}

const filterBooks = computed(() => {
    if (!searchQuery.value) {
        return books.value; // If search query is empty, return all books
    }
    return books.value.filter(book =>
        book.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
})

onMounted(async () => {
    fetchCategory()
    fetchBooks()
    await authStore.fetchUser()
})
</script>
<template>
    <div class="container mx-auto">
        <section class="ml-5 mb-8">
            <div class="w-auto">
                <input v-model="searchQuery" type="text" placeholder="Cari buku"
                    class="input input-bordered input-sm w-full min-w-40 max-w-64 placeholder-red-500 inline-block m-2" />
            </div>
            <div class="mb-10 ml-2">
                <h1 class="text-xl font-medium"># Category</h1>
                <div v-if="allCategory.length <= 0">Loading...</div>
                <div v-else class="flex flex-wrap gap-4 mt-2">
                    <button @click="fetchBooks()" class="btn btn-sm bg-green-500 text-white"
                        :class="{ 'bg-red-400': activeCategory == null }" v-if="allCategory.length > 0">All</button>
                    <button @click="filterBooksByCategory(category.id)" v-for="category in allCategory"
                        class="btn btn-sm bg-green-500 text-white"
                        :class="{ 'bg-red-400': activeCategory === category.id }">{{ category.name }}</button>

                </div>
            </div>
        </section>
        <div v-if="books.length <= 0 && loading == false">
            <h1 class="text-center">Tidak ada buku untuk category ini</h1>
        </div>
        <Books v-else :books="filterBooks" :loading="loading" />
    </div>
</template>