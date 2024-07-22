<script setup>
import FilmsPage from './FilmsPage.vue';
import HeroLayout from '@/components/HeroLayout.vue'


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
        <div class="carousel w-full mb-10">
            <div id="slide1" class="carousel-item relative w-full">
                <HeroLayout />
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide4" class="btn btn-circle">❮</a>
                    <a href="#slide2" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide2" class="carousel-item relative w-full">
                <HeroLayout />
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide1" class="btn btn-circle">❮</a>
                    <a href="#slide3" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide3" class="carousel-item relative w-full">
                <HeroLayout />
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide2" class="btn btn-circle">❮</a>
                    <a href="#slide4" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide4" class="carousel-item relative w-full">
                <HeroLayout />
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide3" class="btn btn-circle">❮</a>
                    <a href="#slide1" class="btn btn-circle">❯</a>
                </div>
            </div>
        </div>
        <FilmsPage />
    </div>
</template>