<script setup>
import { ref } from 'vue'
import pesananku from '@/assets/nuxt-pesananku.png'
import reactBookstore from '@/assets/react-bookstore.png'
import reactMealdb from '@/assets/react-mealdb.png'
import reactRandomquotes from '@/assets/react-randomquotes.png'
import bookshelfApi from '@/assets/bookshelf-api.png'
import filmsApi from '@/assets/reviewfilm-api.png'

const projects = ref([
  {
    id: 1,
    img: pesananku,
    title: 'Pesananku - nuxt',
    link: 'https://github.com/Sekolah-Beta-2023/AbdulCholik-pesananku',
    describe: 'Food ordering application built with Nuxt js and Bootstrap.'
  },
  {
    id: 2,
    img: reactBookstore,
    title: 'react-bookstore',
    link: 'https://github.com/Lik206/bookstore-app',
    describe: 'Build bookstore app with React'
  },
  {
    id: 3,
    img: reactMealdb,
    title: 'reactMeal',
    link: 'https://github.com/Lik206/favFoods',
    describe: 'Build react meals app with TheMealDB api"'
  },
  {
    id: 4,
    img: reactRandomquotes,
    title: 'react-quotes',
    link: 'https://github.com/Lik206/advice-app-react',
    describe: 'Build random quotes with React'

  },
  {
    id: 5,
    img: bookshelfApi,
    title: 'Bookshelf API - Dicoding',
    link: 'https://github.com/Lik206/Bookshelf-Api',
    describe: 'Build bookshelf api with hapi.js'
  },
  {
    id: 6,
    img: filmsApi,
    title: 'Laravel films API',
    link: 'https://github.com/Lik206/Super-Bootcamp-Sanbercode-Laravel-Vue/tree/main/BE-Laravel/review-film',
    describe: 'Build films api with laravel'
  }
])
</script>
<template>
  <div
    v-motion
    :initial="{
      opacity: 0,
      y: -30
    }"
    :visible-once="{
      opacity: 1,
      y: 0,
      transition: {
        duration: 1600
      }
    }"
  >
    <h1 class="text-3xl text-center mt-10">Projects</h1>
    <div class="h-full mt-5 p-5 flex flex-wrap gap-8 justify-around">
      <div v-for="item in projects" :key="item.id" class="card bg-base-100 w-72 shadow-xl">
        <a class="relative group" :href="item.link" target="_blank">
          <span class="absolute h-40 w-full lg:hidden group-hover:block">
            <i class="pi pi-external-link absolute right-2 bottom-0"> </i>
          </span>
          <img :src="item.img" alt="Shoes" class="rounded-t-xl"/>
        </a>
        <div class="card-body">
          <h2 class="card-title text-lg justify-center">
            {{ item.title }}
          </h2>
          <p>{{ item.describe }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
