<script setup>
import { ref } from 'vue';

const films = ref([
    { img: 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF60Qpup1FsCnl-7VTsHzZr8h_yTt9xJXlwZR6FGzitLompt90' },
    { img: 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF60Qpup1FsCnl-7VTsHzZr8h_yTt9xJXlwZR6FGzitLompt90' },
    { img: 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF60Qpup1FsCnl-7VTsHzZr8h_yTt9xJXlwZR6FGzitLompt90' },
    { img: 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF60Qpup1FsCnl-7VTsHzZr8h_yTt9xJXlwZR6FGzitLompt90' },
    { img: 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF60Qpup1FsCnl-7VTsHzZr8h_yTt9xJXlwZR6FGzitLompt90' },
])
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
                    class="card card-compact bg-base-100 w-48 shadow-xl border-5">
                    <figure>
                        <img :src="film.img" alt="film" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
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