import { createRouter, createWebHistory } from 'vue-router'
 
const routes = [
  
  { path: '/', component: () => import('../views/Home.vue') },
  { path: '/home', component: () => import('../views/Home.vue') },
  { path: '/bet', component: () => import('../views/Bet.vue') },
  { path: '/login', component: () => import('../views/Login.vue') },
] 

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router