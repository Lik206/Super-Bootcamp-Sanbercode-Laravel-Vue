<script setup>
import { ref } from 'vue'
import AboutMe from './AboutMe.vue'
import MyExperience from './MyExperience.vue'
import PortFolio from './PortFolio.vue'
import { useMotion } from '@vueuse/motion'

const targetEl = ref()

useMotion(targetEl, {
  initial: {
    opacity: 0,
    y: 100
  },
  visibleOnce: {
    opacity: 1,
    y: 0,
    transition: {
      duration: 1000
    }
  }
})

const github = ref('https://github.com/Lik206')
const linkedin = ref('https://www.linkedin.com/in/abdul-cholik/')
</script>

<template>
  <div>
    <div
      class="h-[380px] mt-5 flex flex-col md:flex-row sm:justify-around bg-gradient-to-r from-teal-100 to-blue-500 p-0"
    >
      <div
        v-motion
        :initial="{
          opacity: 0,
          y: -100
        }"
        :enter="{
          opacity: 1,
          y: 0,
          transition: {
            duration: 1000
          }
        }"
        class="w-auto md:w-1/2 flex flex-col justify-center mt-3 ml-5"
      >
        <h1 class="text-5xl mb-5">Hi There,</h1>
        <h1 class="text-3xl mb-5">I'm Abdul Cholik</h1>
        <p class="text-lg">and I'm ready to become a full stack developer now.</p>
        <div class="flex justify-between w-1/4 ml-5 mt-7 text-3xl">
          <a :href="github" target="_blank">
            <i class="pi pi-github text-gray-600"></i>
          </a>
          <a :href="linkedin" target="_blank">
            <i class="pi pi-linkedin text-[#0A66C2]"></i>
          </a>
        </div>
      </div>
      <div
        v-motion
        :initial="{
          opacity: 0
        }"
        :enter="{
          opacity: 1,
          transition: {
            duration: 1000
          }
        }"
        class="relative backdrop-blur-md bg-white/10"
      >
        <img
          src="../assets/profile.png"
          alt=""
          class="hidden lg:block w-[400px] h-[380px] bg-cover"
          draggable="false"
        />
        <div class="absolute top-[310px] blur-3xl bg-white/35 w-full h-32"></div>
      </div>
    </div>
    <div class="bg-white sm:p-5 md:p-0">
      <AboutMe ref="targetEl" />
    </div>
    <PortFolio />
    <MyExperience />
  </div>
</template>
