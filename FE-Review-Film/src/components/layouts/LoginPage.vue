<script setup>
import AuthComponent from '@/components/AuthComponent.vue'
</script>
<template>
    <div v-motion :initial="{
        opacity: 0
    }" :visible="{
        opacity: 1,
    }" class="flex justify-center h-96 mt-20 items-center">
        <section class="px-8 py-20  rounded-xl ">

            <AuthComponent title="Login" />
        </section>
    </div>
</template>