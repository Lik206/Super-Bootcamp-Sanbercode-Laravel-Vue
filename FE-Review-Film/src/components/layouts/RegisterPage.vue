<script setup>
import AuthComponent from '../AuthComponent.vue';
</script>
<template>
    <div v-motion :initial="{
        opacity: 0
    }" :visible="{
        opacity: 1,
    }" class="flex justify-center h-96 items-center mt-20">
        <section class="px-8 py-20 rounded-xl ">

            <AuthComponent title="Register" />
        </section>
    </div>
</template>