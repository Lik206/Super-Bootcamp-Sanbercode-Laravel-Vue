import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { CustomAPI } from '@/api'

export const useAuthStore = defineStore('auth', () => {
  const router = useRouter()
  const token = ref(
    localStorage.getItem('token') ? JSON.parse(localStorage.getItem('token')) : null
  )
  const user = ref(localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null)

  const isError = ref(false)
  const errMessage = ref('')

  const register = async (inputData) => {
    try {
      const { name, email, password, passwordConfirmation } = inputData

      const { data } = await CustomAPI.post('/auth/register', {
        name: name,
        email: email,
        password: password,
        password_confirmation: passwordConfirmation
      })
      
      token.value = data.token
      user.value = data.user

      localStorage.setItem('token', JSON.stringify(data.token))
      localStorage.setItem('user', JSON.stringify(data.user))

      console.log(data);
      router.push({name: 'verification'})
    } catch (error) {
      console.log(error)
    }
  }

  const loginUser = async (inputData) => {
    try {
      isError.value = false
      errMessage.value = ''

      const { email, password } = inputData

      const { data } = await CustomAPI.post('auth/login', {
        email: email,
        password: password
      })

      const { token: tokenUser, user: userData } = data

      token.value = tokenUser
      user.value = userData

      localStorage.setItem('token', JSON.stringify(tokenUser))
      localStorage.setItem('user', JSON.stringify(userData))

      router.push({ name: 'home' })
    } catch (error) {
      isError.value = true
      errMessage.value = error.response.data.error
    }
  }

  const logoutUser = async () => {
    try {
      const { data } = await CustomAPI.post(
        '/auth/logout',
        {},
        {
          headers: { Authorization: `Bearer ${token.value}` }
        }
      )
      alert(data.message)

      localStorage.removeItem('token')
      localStorage.removeItem('user')

      token.value = null
      user.value = null

      router.push({ name: 'login' })
    } catch (error) {
      console.log(error)
    }
  }

  const getMe = async () => {
    try {
      const res = await CustomAPI.get('/me', {
        headers: { Authorization: `Bearer ${token.value}` }
      })

      user.value = res.data.user

      localStorage.setItem('user', JSON.stringify(res.data.user))
    } catch (error) {
      console.log(error)
    }
  }

  const updateUser = async (inputName) => {
      try {
        const res = await CustomAPI.post(
          '/update-user',
          {
            name: inputName.value
          },
          {
            headers: { Authorization: `Bearer ${token.value}` }
          }
        )
        console.log(res.data)
        getMe()
        alert('update username berhasil')
        router.push({name: 'home'})

      } catch (error) {
        console.log(error)
      }
  }

  const generateOtp = async () => {
    const res = await CustomAPI.post(
      '/auth/generate-otp-code',
      {
        email: user.value.email
      },
      {
        headers: { Authorization: `Bearer ${token.value}` }
      }
    )

    console.log(res)
  }

  const verification = async (inputOtp) => {
    try {
      const res = await CustomAPI.post(
        '/auth/verifikasi-akun',
        {
          otp: inputOtp.value
        },
        {
          headers: { Authorization: `Bearer ${token.value}` }
        }
      )

      console.log(res.data)
      getMe()
      alert('berhasil verifikasi')
      router.push({name: 'home'})
    } catch (error) {
      console.log(error)
    }
  }

  return {
    token,
    register,
    loginUser,
    logoutUser,
    isError,
    errMessage,
    user,
    getMe,
    generateOtp,
    verification,
    updateUser
  }
})
