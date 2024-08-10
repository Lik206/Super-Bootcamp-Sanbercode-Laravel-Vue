<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, ref } from 'vue';
import EditRole from './EditRole.vue';

const authStore = useAuthStore()
const allRole = ref([])
const loading = ref(false)

const fetchRoles = async () => {
    loading.value = true
    try {
        const res = await CustomAPI.get('/role', {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        allRole.value = res.data.data
    } catch (error) {
        console.log(error);
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchRoles()
})

const addRole = ref('')

const createRole = async (inputData) => {
    try {
        await CustomAPI.post('/role', { name: inputData }, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchRoles()
    } catch (error) {
        console.log(error);
    }
}

const handleCreateRole = () => {
    createRole(addRole.value)
    addRole.value = ''
}

const deleteRole = async (id) => {
    try {
        await CustomAPI.post(`/role/${id}?_method=delete`, {}, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        fetchRoles()
    } catch (error) {
        console.log(error);
    }
}
</script>
<template>
    <h2>All Role</h2>
    <div class="my-2">
        <button class="btn btn-sm btn-secondary" onclick="create_role.showModal()">Create Role</button>
        <dialog id="create_role" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <form @submit.prevent="handleCreateRole()">
                    <label class="input input-bordered flex items-center gap-2 my-3">
                        <input v-model="addRole" type="text" class="grow" placeholder="add Role" />
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
                    <th>Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(role, index) in allRole">
                    <th>{{ index + 1 }}</th>
                    <td>{{ role.name }}</td>
                    <td class="flex justify-around" v-if="role.name !== 'owner'">
                        <EditRole :index="index" :id="role.id" :name="role.name" @fetch-roles="fetchRoles" />
                        <button @click="deleteRole(role.id)" class="btn btn-sm bg-red-600 text-white">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>