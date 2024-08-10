<template>
    <button class="btn btn-sm btn-primary" @click="show">edit</button>
    <dialog :id="`edit_category-${index}`" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form @submit.prevent="handleUpdateCategory()">
                <label class="input input-bordered flex items-center gap-2 my-3">
                    <input type="text" v-model="inputCategory" :placeholder="props.name" class="grow" />
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

const emit = defineEmits(['fetch-category'])
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
    const dialog = document.getElementById(`edit_category-${props.index}`);

    dialog.showModal()
}

const inputCategory = ref('')
const editCategory = async (id,input) => {
    const authStore = useAuthStore()
    try {
        await CustomAPI.post(`/category/${id}?_method=put`, {
            name: input
        }, {
            headers: {
                Authorization: `Bearer ${authStore.token}`
            }
        })
        emit('fetch-category')
        // alert(res.data.message)
    } catch (error) {
        console.log(error);
    }
}

const handleUpdateCategory = () => {
    editCategory(props.id, inputCategory.value)
    inputCategory.value = ''
}
</script>