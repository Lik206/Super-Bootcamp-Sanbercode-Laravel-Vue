<script setup>
import { CustomAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { onMounted, reactive, ref } from 'vue'

const authStore = useAuthStore()

const inputMovie = reactive({
  title: '',
  summary: '',
  year: '',
  poster: null,
  genre_id: ''
})

const genres = ref([])

const fetchGenre = async() => {
  try {
    const {data} = await CustomAPI.get('/genre')
    genres.value = data.data
  } catch (error) {
    console.log(error);
  }
}

const getPoster = (e) => {
  inputMovie.poster = e.target.files[0]
}

const handleSubmit = async () => {
  try {
    let form = new FormData()

  form.append('title', inputMovie.title)
  form.append('summary', inputMovie.summary)
  form.append('year', inputMovie.year)
  form.append('poster', inputMovie.poster)
  form.append('genre_id', inputMovie.genre_id)

  // eslint-disable-next-line no-unused-vars
  const newMovie = await CustomAPI.post('/movie', form, {
        headers: { Authorization: `Bearer ${authStore.token}` }
      })

      alert('berhasil tambah movie')
  } catch (error) {
    console.log(error);
  }
}

onMounted(() => {
  fetchGenre()
})
</script>

<template>
  <dialog id="my_modal_3" class="modal">
    <div class="modal-box">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <form @submit="handleSubmit">
        <label class="input input-bordered flex items-center gap-2 my-3">
          <input type="text" class="grow" placeholder="title movie" v-model="inputMovie.title"/>
        </label>
        <label class="flex items-center gap-2 my-3">
          <textarea
            placeholder="Summary"
            class="textarea textarea-bordered textarea-lg w-full max-w-full"
            v-model="inputMovie.summary"
          ></textarea>
        </label>
        <label class="flex items-center gap-2 my-3">
          <select v-model="inputMovie.genre_id" class="select select-bordered w-full max-w-xs">
            <option disabled selected>Choose genre</option>
            <option :value="genre.id" v-for="(genre,index) in genres" :key="index">{{genre.name}}</option>
          </select>
        </label>
        <label class="input input-bordered flex items-center gap-2 my-3">
          <input v-model="inputMovie.year" type="number" class="grow" placeholder="year" />
        </label>
        <label class="flex items-center gap-2 my-3">
          <input @change="getPoster" type="file" class="file-input file-input-bordered w-full max-w-xs" />
        </label>
        <input type="submit" value="submit" class="btn btn-primary" />
      </form>
    </div>
  </dialog>
</template>
