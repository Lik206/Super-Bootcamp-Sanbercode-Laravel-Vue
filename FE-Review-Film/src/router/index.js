import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import VerificationView from '@/views/VerificationView.vue'
import FilmsView from '@/views/FilmsView.vue'
import GenreView from '@/views/GenreView.vue'
import CastView from '@/views/CastView.vue'
import ProfileView from '@/views/ProfileView.vue'
import EditView from '@/views/EditView.vue'
import { useAuthStore } from '@/stores/AuthStore'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { requiredAuth: true }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: { requiredAuth: true }
    },
    {
      path: '/verification-account',
      name: 'verification',
      component: VerificationView
    },
    {
      path: '/films',
      name: 'film',
      component: FilmsView
    },
    {
      path: '/genre',
      name: 'genre',
      component: GenreView
    },
    {
      path: '/cast',
      name: 'cast',
      component: CastView
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfileView,
      meta: { isAuth: true }
    },
    {
      path: '/profile/edit',
      name: 'editProfile',
      component: EditView,
      meta: { isAuth: true, verification: true }
    }
  ]
})

router.beforeEach(async (to) => {
  const authStore = await useAuthStore()
  if (to.meta.requiredAuth && authStore.token) {
    return {
      path: '/'
    }
  }
  // if not login can't access profile page
  if (to.meta.isAuth && authStore.token == null) {
    return {
      path: '/'
    }
  }
  
  if (to.meta.verification && authStore.user.email_verified_at == null) {
    alert('belum verifikasi email')
    return {
      name: 'verification'
    }
  }

})

export default router
