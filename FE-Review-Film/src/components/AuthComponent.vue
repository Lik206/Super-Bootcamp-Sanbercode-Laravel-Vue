<script setup>
import {reactive} from 'vue'
import { useAuthStore } from '@/stores/AuthStore'

const authStore = useAuthStore()
const { loginUser, register } = authStore

const userInput = reactive({
  name: '',
  email: '',
  password: '',
  passwordConfirmation: ''
})

const props = defineProps({
  title: String
})

const handleSubmit = () => {
  if(props.title === 'Login') {
    loginUser(userInput)
  }else {
     register(userInput)
  }
  
}
</script>

<template>
  <div>
    <h1 class="text-center mb-5 text-2xl m-[-50px]">{{ props.title }}</h1>
    <div v-if="props.title == 'Login' && authStore.isError &&authStore.errMessage" role="alert" class="alert alert-error mb-5">
      <span>{{ authStore.errMessage }}</span>
    </div>
    <section v-if="props.title == 'Register' && authStore.isError && authStore.msgForRegister" >
      <div  role="alert" class="alert alert-error mb-5"  v-for="(msg, key) in authStore.msgForRegister" :key="key">
        <p v-if="msg && msg[0] ">
          {{ msg[0] }}
        </p>
      </div>
    </section>
    <form @submit.prevent="handleSubmit()" class="flex flex-col gap-5">
      <label v-if="props.title !== 'Login'" class="input input-bordered flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70"
        >
          <path
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
          />
        </svg>
        <input v-model="userInput.name" type="text" class="grow" placeholder="Username" required/>
      </label>
      <label class="input input-bordered flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70"
        >
          <path
            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z"
          />
          <path
            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z"
          />
        </svg>
        <input v-model="userInput.email" type="text" class="grow" placeholder="Email" required/>
      </label>
      <label class="input input-bordered flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70"
        >
          <path
            fill-rule="evenodd"
            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
            clip-rule="evenodd"
          />
        </svg>
        <input v-model="userInput.password" type="password" class="grow" placeholder="password" required/>
      </label>
      <label v-if="props.title !== 'Login'" class="input input-bordered flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70"
        >
          <path
            fill-rule="evenodd"
            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
            clip-rule="evenodd"
          />
        </svg>
        <input
          v-model="userInput.passwordConfirmation"
          type="password"
          class="grow"
          placeholder="password confirmation"
          required
        />
      </label>
      <button type="submit" class="btn bg-sky-500 text-white">Submit</button>
    </form>
  </div>
</template>
