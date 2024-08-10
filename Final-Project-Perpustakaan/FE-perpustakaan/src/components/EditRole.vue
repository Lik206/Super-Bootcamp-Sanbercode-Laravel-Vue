<template>
    <button class="btn btn-sm btn-primary" @click="show">edit</button>
    <dialog :id="`edit_role-${index}`" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form @submit.prevent="handleEditRole()">
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input v-model="inputRole" type="text" :placeholder="props.name" class="grow" />
                </label>
                <input type="submit" value="edit" class="btn btn-primary" />
            </form>
        </div>
    </dialog>
</template>
<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { defineProps, ref, defineEmits } from 'vue';

const authStore = useAuthStore()
const emit = defineEmits(['fetch-roles'])
const props = defineProps({
    index: {
        type: Number,
        required: true,
    },
    name: {
        type: String,
        required: true
    },
    id: {
        type: String,
        required: true
    }
})

const show = () => {
    const dialog = document.getElementById(`edit_role-${props.index}`);

    dialog.showModal()
}

const inputRole = ref('')

const editRole = async (id, input) => {
    try {
        await CustomAPI.post(`/role/${id}?_method=put`, { name: input }, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        emit('fetch-roles')
    } catch (error) {
        console.log(error);
    }
}

const handleEditRole = () => {
    editRole(props.id, inputRole.value)
    inputRole.value = ''
}

</script>
