import { createRouter, createWebHistory } from 'vue-router'
import MainPage from '../views/Main.vue'
import Models from '../views/Models.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'MainPage',
      component: MainPage,
    },
    {
      path: '/models',
      name: 'Models',
      component: Models,
    },
    {
      path: '/configurator',
      name: 'Configurator',
      component: () => import('../views/Configurator.vue'),
    },
  ],
})

export default router