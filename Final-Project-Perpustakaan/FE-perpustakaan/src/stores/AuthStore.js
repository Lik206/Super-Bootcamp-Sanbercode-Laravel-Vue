import { ref} from 'vue'
import { defineStore } from 'pinia'
import { CustomAPI } from '@/api'
import { useRouter } from 'vue-router'

export const useAuthStore = defineStore('auth', () => {
  const router = useRouter()
  const token = ref(
    localStorage.getItem('token')
      ? JSON.parse(localStorage.getItem('token'))
      : null
  )
  const user = ref(
    localStorage.getItem('user')
      ? JSON.parse(localStorage.getItem('user'))
      : null
  )
  const role = ref(
    localStorage.getItem('role')
      ? JSON.parse(localStorage.getItem('role'))
      : null
  )

  const isLogin = ref(
    localStorage.getItem('islogin')
      ? JSON.parse(localStorage.getItem('islogin'))
      : false
  )

  const isError = ref(false)
  const errMessageRegister = ref([])
  const errMsgLogin = ref('')

  const register = async (inputData) => {
    try {
      const { name, email, password, passwordConfirmation } = inputData
      errMessageRegister.value = []

      const {data} = await CustomAPI.post('/auth/register', {
        name: name,
        email: email,
        password: password,
        password_confirmation: passwordConfirmation
      })
      token.value = data.token
      user.value = data.user
      role.value = data.user.roles.name
      isLogin.value = true

      localStorage.setItem('token', JSON.stringify(data.token))
      localStorage.setItem('user', JSON.stringify(data.user))
      localStorage.setItem('role', JSON.stringify(data.user.roles.name))
      localStorage.setItem('isLogin', JSON.stringify(true))

      router.push({ name: 'home' })
    } catch (error) {
      
      const data = error.response.data
      errMessageRegister.value = []
      for(const msg in data) {
        errMessageRegister.value.push(data[msg].join(', '))
      }
    }
  }

  const login = async (inputData) => {
    try {
      isError.value = false
      errMsgLogin.value = ''

      const { email, password } = inputData

      const { data } = await CustomAPI.post('auth/login', {
        email: email,
        password: password,
      })

      const { token: tokenUser, user: userData } = data

      token.value = tokenUser
      user.value = userData
      isLogin.value = true
      role.value = userData.roles.name

      localStorage.setItem('token', JSON.stringify(tokenUser))
      localStorage.setItem('user', JSON.stringify(userData))
      localStorage.setItem('role', JSON.stringify(userData.roles.name))
      localStorage.setItem('islogin', JSON.stringify(true))

      router.push({ name: 'home' })
    } catch (error) {
      isError.value = true
      errMsgLogin.value = error.response.data.error

    }
  }

  const logout = async () => {
    try {
      const { data } = await CustomAPI.post(
        '/auth/logout',
        {},
        {
          headers: { Authorization: `Bearer ${token.value}` },
        }
      )

      localStorage.removeItem('token')
      localStorage.removeItem('user')
      localStorage.removeItem('role')
      localStorage.setItem('islogin', JSON.stringify(false))


      token.value = null
      isLogin.value = false
      user.value = null
      role.value = null

      router.push({name: 'login'})
    } catch (error) {
      localStorage.setItem('islogin', JSON.stringify(false))
      router.push({name: 'login'})
    }
  }

  const fetchUser = async () => {
    try {
      const { data } = await CustomAPI.get('/me', {
        headers: { Authorization: `Bearer ${token.value}` },
      })

      isLogin.value = true

      localStorage.setItem('isLogin', JSON.stringify(true))
      const { user } = data
      return user
    } catch (error) {
      console.log(error)
    }
  }
  
  return {
    isLogin,
    token,
    user,
    role,
    errMessageRegister,
    errMsgLogin,
    register,
    login,
    logout,
    fetchUser
  }
})
