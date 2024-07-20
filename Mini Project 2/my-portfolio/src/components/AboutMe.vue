<template>
  <div
    v-motion
    :initial="{
      opacity: 0,
      y: -100
    }"
    :visible-once="{
      opacity: 1,
      y: 0,
      transition: {
        duration: 1000
      }
    }"
    class="h-full flex justify-center items-center p-5"
  >
    <div class="w-[700px] h-96 flex flex-col items-center justify-center">
      <h1 class="mb-5 text-3xl text-center">About Me</h1>
      <div v-html="summary"></div>
    </div>
  </div>
</template>
<script setup>
import { ref } from 'vue'

const summary = ref(
  `<p class="mb-3">As a high school graduate with a strong passion for the IT world, I have developed skills and knowledge through my work experiences in various fields. From being a production operator in a factory to a store crew in a minimarket, I have gained a solid understanding of work ethic, teamwork, and time management.</p>

  <p>Now, I am excited to apply these skills and knowledge in my IT career. Over time, I have honed my technical skills in HTML, CSS, JavaScript, Bootstrap, Tailwind, Vue.js, Nuxt.js, React.js, Node.js, SQL, Mysql, PHP, and Laravel. My unique background and diverse experiences can bring a fresh and innovative perspective to the IT industry. I am  eager to contribute, learn, and grow within this dynamic field.</p>`
)
</script>
