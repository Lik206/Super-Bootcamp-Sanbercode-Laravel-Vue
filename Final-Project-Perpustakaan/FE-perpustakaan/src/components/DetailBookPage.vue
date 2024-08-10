<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const authStore = useAuthStore()
const route = useRoute()
const detailBook = ref('')
const statusBorrow = ref(false)
const loading = ref(false)

const getStatusBorrow = () => {
    const listBorrow = detailBook.value.list_borrows

    for (const user of listBorrow) {
        if (user.user_id == authStore.user.id) {
            statusBorrow.value = true
        } else {
            statusBorrow.value = false
        }
    }

}

const fetchDetailBook = async (id) => {
    loading.value = true
    try {
        const res = await CustomAPI.get(`/book/${id}`)
        detailBook.value = res.data.data
        // console.log(detailBook.value.id);
        getStatusBorrow()
    } catch (error) {
        console.log(error);
    }finally {
        loading.value = false
    }
}

const generatedDatetime = ref('');

const setCurrentDatetime = () => {
    const now = new Date();
    generatedDatetime.value = now.toISOString().slice(0, 16);
};

const borrowBook = async () => {
    try {
        setCurrentDatetime()

        const res = await CustomAPI.post('/borrow', {
            load_date: generatedDatetime.value,
            borrow_date: generatedDatetime.value,
            book_id: detailBook.value.id,
            user_id: authStore.user.id
        }, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchDetailBook(route.params.id)
    } catch (error) {
        console.log(error);
    }
}



onMounted(() => {
    fetchDetailBook(route.params.id)
})
</script>

<template>
    <div v-if="loading" class=" h-96 flex justify-center items-center">Loading...</div>
    <div v-else class="container bg-slate-100 mx-auto">
        <div class="flex justify-center bg-slate-600">
            <img :src="detailBook.image" class="object-contain h-48 w-96" />
        </div>
        <section class="mt-5 p-5">
            <h1 class="text-2xl font-semibold mb-5">{{ detailBook.title }}</h1>
            <h2 class="text-gray-500 text-xl mb-5">Stock: {{ detailBook.stok > 0 ? detailBook.stok : 'Habis' }}</h2>
            <p class="text-sm">{{ detailBook.summary }}
            </p>
        </section>

        <div class="flex justify-center mb-20">
            <button v-if="authStore.token" :disabled="statusBorrow || detailBook.stok < 1" :class="{ 'bg-gray-500': statusBorrow, 'bg-blue-500': !statusBorrow }"
                class="btn btn-primary" @click="borrowBook()">
                {{statusBorrow ? 'Sedang Dipinjam' : 'Pinjam'}}
            </button>
        </div>
    </div>
</template>