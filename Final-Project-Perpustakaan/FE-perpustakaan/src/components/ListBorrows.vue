<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { ref, onMounted } from 'vue';

const authStore = useAuthStore()
const allBorrows = ref([])
const loading = ref(false)
const fetchBorrows = async () => {
    loading.value = true
    try {
        const res = await CustomAPI.get('/borrow', {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        allBorrows.value = res.data.data
    } catch (error) {
        console.log(error);
    }finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchBorrows()
})


</script>

<template>
    <h1>borrows</h1>
    <div class="overflow-x-auto">
        <div v-if="loading">Loading...</div>
        <table v-else class="table border-collapse border border-slate-500">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>User</th>
                    <th class="text-center">Book</th>
                    <th class="text-center">load date</th>
                    <th class="text-center">borrow date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in allBorrows">
                    <th>{{ index + 1 }}</th>
                    <td>{{ data.user.name }}</td>
                    <td>
                        <h3 class="text-center">{{ data.book.title }}</h3>
                    </td>
                    <td class="text-center">{{ data.load_date }}</td>
                    <td class="text-center">{{ data.borrow_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>