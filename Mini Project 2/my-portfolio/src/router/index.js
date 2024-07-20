import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/my-portfolio',
      name: 'portfolio',
      component: () => import('../views/PortfolioView.vue')
    },
    {
      path: '/my-experience',
      name: 'experience',
      component: () => import('../views/ExperienceView.vue')
    }
  ]
})

export default router
