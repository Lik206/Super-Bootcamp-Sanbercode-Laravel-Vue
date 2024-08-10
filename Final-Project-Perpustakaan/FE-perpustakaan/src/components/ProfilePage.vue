<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, reactive, ref } from 'vue';

const authStore = useAuthStore()

const getMe = ref(null)

const myBorrow = ref(null)



const inputProfile = reactive({
    age: '',
    bio: ''
})

const addProfile = async (inputData) => {
    try {
        const { age, bio } = inputData
        const { data } = await CustomAPI.post('/profile', {
            age, bio
        }, {
            headers: { Authorization: `Bearer ${authStore.token}` }
        })
        console.log(data);
        await authStore.fetchUser()

    } catch (error) {
        console.log(error);

    }
}

const handleSubmit = async () => {
    addProfile(inputProfile)
    
    const user = await authStore.fetchUser()
    getMe.value = user
    myBorrow.value = user.borrow
    console.log(user);
}

onMounted(async () => {
    const user = await authStore.fetchUser()
    getMe.value = user
    myBorrow.value = user.borrow
    console.log(user);
})
</script>
<template>
    <div class="h-full flex flex-col gap-2  justify-center items-center">
        <div v-if="!getMe"></div>
        <div v-else class="mockup-browser bg-base-300 border w-96 lg:w-1/2">
            <div class="mockup-browser-toolbar">
            </div>
            <div class="bg-base-200 px-4 py-16">
                <h1>Profile</h1>
                <hr class="h-1 bg-gray-400" />
                <h2 class="mt-5">
                    Username: <span class="inline-block ml-8 text-gray-500">{{ getMe.name }}</span>
                </h2>
                <h2>
                    email: <span class="inline-block ml-16 text-gray-500">{{ getMe.email }}</span>
                </h2>
                <h2>
                    age: <span class="inline-block mx-4 text-gray-500">{{ getMe.profile ? getMe.profile.age : '-'
                        }}</span>
                </h2>
                <section>
                    <div class="flex justify-between">
                        <h2>Bio :</h2>
                        <button class="btn btn-sm" onclick="my_modal_3.showModal()">
                            <i class="pi pi-pencil"></i>
                        </button>
                        <dialog id="my_modal_3" class="modal">
                            <div class="modal-box p-10">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Lengkapi Profile</h3>
                                <form @submit="handleSubmit()" class="relative">
                                    <label class="form-control my-3">
                                        Age :
                                        <input v-model="inputProfile.age" type="number" placeholder="age"
                                            class="input input-bordered input-sm w-full max-w-xs" />
                                    </label>
                                    <label class="form-control mb-3">
                                        Bio :
                                        <textarea v-model="inputProfile.bio" class="textarea textarea-bordered w-full"
                                            placeholder="Bio"></textarea>
                                    </label>
                                    <button class="btn btn-sm btn-secondary absolute right-0">submit</button>
                                </form>
                            </div>
                        </dialog>
                    </div>
                    <p class="text-gray-400">{{ getMe.profile ? getMe.profile.bio : 'Not have bio' }}</p>
                </section>
            </div>
        </div>

        <div>
            <h1 class="text-3xl mb-5">My Book Borrow</h1>
            <div class="card card-compact bg-base-100 w-[230px] shadow-xl" v-if="myBorrow">
                <div class="flex justify-center">
                    <img :src="myBorrow.book.image" alt="tes" class="object-cover w-[auto] h-[200px]" />
                </div>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">{{ myBorrow.book.title }}</h2>
                    <div class="card-actions">
                        <button class="btn bg-gray-500 text-white">Sedang Dipinjam</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>