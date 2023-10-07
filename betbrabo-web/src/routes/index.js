// import Home from '@/views/Home.vue'
// import Login from '@/views/Login.vue'
import { createRouter, createWebHistory } from 'vue-router'
 
const routes = [
  // { path: '/', component: Home },
  // { path: '/home', component: Home },
  // { path: '/login', component: Login },
  
  { path: '/', component: () => import('../views/Home.vue') },
  { path: '/home', component: () => import('../views/Home.vue') },
  { path: '/login', component: () => import('../views/Login.vue') },
] 

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router