import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import VerificationView from '@/views/VerificationView.vue'
import FilmsView from '@/views/FilmsView.vue'
import GenreView from '@/views/GenreView.vue'
import CastView from '@/views/CastView.vue'

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
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
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
    }
  ]
})

export default router
