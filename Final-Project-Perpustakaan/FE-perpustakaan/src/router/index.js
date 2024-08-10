import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DashboardView from '@/views/DashboardView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import ProfileView from '@/views/ProfileView.vue'
import DetailBookView from '@/views/DetailBookView.vue'
import { useAuthStore } from '@/stores/AuthStore'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfileView,
    },
    {
      path: '/detail-book/:id',
      name: 'detailBook',
      component: DetailBookView,
    },
  ],
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  if (to.name === 'login' && authStore.token && authStore.isLogin) next({ name: 'home' })
  if (to.name === 'register' && authStore.token && authStore.isLogin) next({ name: 'home' })
  if (to.name === 'profile' && !authStore.token && !authStore.isLogin) next({ name: 'home' })
  if (to.name === 'dashboard' && authStore.role !== 'owner') next({ name: 'home' });
  else next()
})

export default router
