<script setup>
import { CustomAPI } from '@/api';
import { onMounted, ref } from 'vue';

const films = ref([
])

const getAllMovie = async() => {
    try {
        const {data} = await CustomAPI.get('/movie')
        films.value = data.data
        console.log(data.data);
    } catch (error) {
        const {response} = error
        console.log(response.data.message);
    }
}

onMounted(() => {
    getAllMovie()
})
</script>

<template>
    <div v-motion :initial="{
        y: -100,
        opacity: 0
    }" :visible-once="{
        y: 0,
        opacity: 1,
        transition: { type: 'spring', stiffness: 20 }
    }">
        <div class="p-10 flex justify-center">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8 w-[75%]">
                <div v-for="(film, index) in films" :key="index"
                    class="card card-compact bg-base-100 w-60 shadow-xl border-5">
                    <figure>
                        <img class="h-48 object-cover" :src="film.poster" alt="film" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{film.title}}</h2>
                        <p>{{film.summary}}</p>
                        <div class="card-actions justify-end">
                            <button class="btn" onclick="my_modal_4.showModal()">open modal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- You can open the modal using ID.showModal() method -->
        <dialog id="my_modal_4" class="modal">
            <div class="modal-box w-11/12 max-w-xl">
                <h3 class="text-lg font-bold">Hello!</h3>
                <p class="py-4">Click the button below to close</p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button, it will close the modal -->
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
</template>