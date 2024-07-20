<script setup>
import { ref } from 'vue'

const experiences = ref([
  {
    place: 'Bootcamp SekolahBeta-Nuxtjs',
    duration: 'Agustus 2023 - October 2023',
    describe:
      'I participated in a Nuxt.js bootcamp organized by Sekolah Beta - 1000StartupDigital. During the program, we focused on the basics of Nuxt.js, learning how to set up and utilize the framework effectively. We delved into client-side rendering (CSR) and server-side rendering (SSR), understanding their differences and applications. By the end of the bootcamp, each participant built a project, applying the knowledge and skills acquired throughout the course.'
  },
  {
    place: 'SMAN 1 MAJA',
    duration: '2018 - 2021',
    describe:
      'Social science'
  }
])

const certification = ref([
  {
    title: 'Bootcamp Online Sekolah Beta Intensif Hacker Progressive Web Apps Menggunakan Nuxt JS',
    penerbit: '1000StartupDigital - Kominfo',
    tglTerbit: '23 October 2023',
    logo: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDsOzP3stzZ_x5pvUMscxmDoW56_A4ztmgdg&s',
    link: 'https://drive.google.com/file/d/1phF_58bV_c1LbYIxFE3s3vQOah4mwMBM/view?usp=sharing'
  },
  {
    title: 'Pelatihan Programming (FullStack) Fase 1',
    penerbit: 'Jabar Digital Academy',
    tglTerbit: '1 April 2024',
    logo: 'https://media.licdn.com/dms/image/D560BAQEEquHj2suFZg/company-logo_100_100/0/1705677896938?e=1729123200&v=beta&t=j4fl3lgHsLsbxNuNxXwvveJ94OATUPbMbjZD6lqIsmY',
    link: 'https://drive.google.com/file/d/1-rRi9wkQJRe6vrH5YBONCqflgoDOgu2E/view'
  },
  {
    title: 'Alibaba Cloud Certification',
    penerbit: 'Alibaba Cloud',
    tglTerbit: '25 February 2024',
    logo: 'https://media.licdn.com/dms/image/C510BAQF79kkZjBKHDA/company-logo_100_100/0/1630633364113/alibaba_cloud_computing_company_logo?e=1729728000&v=beta&t=QJWHz7MimW5xvSlpvGJK-b2qEfEwEacXPO0JevgHrfU',
    link: 'https://drive.google.com/file/d/1B3xc22I91HYymlmy7LeVU27RtO1q0RQ3/view'
  },
  {
    title: 'Belajar Membuat Front-End Web untuk Pemula',
    penerbit: 'Dicoding Indonesia',
    tglTerbit: '27 October 2023',
    logo: 'https://media.licdn.com/dms/image/C560BAQHOIi63tC8k8w/company-logo_200_200/0/1660182933847/dicoding_logo?e=1729728000&v=beta&t=5LpQEnjTatJlWgBTaadjOX2Qzv5y8w4o749zI49kNSw',
    link: 'https://www.dicoding.com/certificates/GRX52EOWKX0M'
  },
  {
    title: 'Belajar Membuat Aplikasi Back-End untuk Pemula',
    penerbit: 'Dicoding Indonesia',
    tglTerbit: '11 June 2023',
    logo: 'https://media.licdn.com/dms/image/C560BAQHOIi63tC8k8w/company-logo_200_200/0/1660182933847/dicoding_logo?e=1729728000&v=beta&t=5LpQEnjTatJlWgBTaadjOX2Qzv5y8w4o749zI49kNSw',
    link: 'https://www.dicoding.com/certificates/NVP7O5W2VPR0'
  }
])
</script>

<template>
  <div>
    <h1 class="text-3xl ml-10 mt-10">My Experience</h1>
    <div
      v-motion
      :initial="{
        x: -200,
        opacity: 0
      }"
      :visible-once="{
        x: 0,
        opacity: 1,
        transition: { type: 'spring', stiffness: 20 }
      }"
      v-for="(experience, index) in experiences"
      :key="index"
      class="px-10 py-3 mb-10"
    >
      <div class="border-green-500 border-l-4 rounded-r-2xl bg-slate-200 p-5">
        <h1>{{ experience.place }}</h1>
        <h2 class="text-gray-400">{{ experience.duration }}</h2>
        <p>
          {{ experience.describe }}
        </p>
      </div>
    </div>
    <h1 class="text-3xl ml-10">My Certificate</h1>
    <div class="m-3 p-5 bg-white/100 rounded">
      <div
        v-motion
        :initial="{
          x: -200,
          opacity: 0
        }"
        :visible-once="{
          x: 0,
          opacity: 1,
          transition: { type: 'spring', stiffness: 10 }
        }"
        v-for="(certif, index) in certification"
        :key="index"
        class="flex flex-row gap-3 w-full border-2 rounded-sm mb-5 p-2"
      >
        <div class="flex-none">
          <img :src="certif.logo" class="w-12 rounded-md" alt="" />
        </div>
        <div class="flex-1 px-3">
          <h1 class="text-xl">{{ certif.title }}</h1>
          <h2 class="text-sm">{{ certif.penerbit }}</h2>
          <h2 class="text-sm text-gray-400">{{ certif.tglTerbit }}</h2>
          <a :href="certif.link" target="_blank">
            <button class="btn btn-outline p-3 my-5 w-[200px]">
              Show credential
              <i class="pi pi-external-link"></i>
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
