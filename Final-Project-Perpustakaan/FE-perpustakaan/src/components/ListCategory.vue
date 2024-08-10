<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref } from 'vue';
import EditCategory from './EditCategory.vue';

const authStore = useAuthStore()
const loading = ref(false)
const allCategory = ref([])
const fetchCategory = async () => {
    loading.value = true
    try {
        const res = await CustomAPI.get('/category')
        allCategory.value = res.data.data
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
}

const addCategory = ref('')

const createCategory = async (inputData) => {
    loading.value = true
    try {
        await CustomAPI.post('/category', {
            name: inputData
        }, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchCategory()
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
}

const handleSubmitCategory = () => {
    createCategory(addCategory.value)
    addCategory.value = ''
}

const deleteCategory = async (id) => {
    loading.value = true
    try {
        const res = await CustomAPI.post(`/category/${id}?_method=delete`, {}, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchCategory()
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchCategory()
})
</script>
<template>
    <h2>All Category</h2>
    <div class="my-2">
        <button class="btn btn-sm btn-secondary" onclick="create_category.showModal()">Create Category</button>
        <dialog id="create_category" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <form @submit.prevent="handleSubmitCategory()" method="dialog">
                    <label class="input input-bordered flex items-center gap-2 my-3">
                        <input v-model="addCategory" type="text" class="grow" placeholder="add Category" />
                    </label>
                    <input type="submit" value="create" class="btn btn-primary" />
                </form>
            </div>
        </dialog>
    </div>
    <div class="overflow-x-auto">
        <div v-if="loading">Loading...</div>
        <table v-else class="table border-collapse border border-slate-500">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr v-for="(category, index) in allCategory">
                    <th>{{index + 1}}</th>
                    <td>{{ category.name }}</td>
                    <td class="flex justify-around">
                        <EditCategory :id="category.id" :index="index" :name='category.name'
                            @fetch-category="fetchCategory" />
                        <button class="btn btn-sm bg-red-600 text-white"
                            @click="deleteCategory(category.id)">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>