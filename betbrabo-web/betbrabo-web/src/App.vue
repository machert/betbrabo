<script setup>
  import { validateToken } from '@/services/validateToken'
  import { onMounted } from 'vue'
  import { RouterLink, RouterView} from 'vue-router'
  
  const handleLogout = () => {
    localStorage.removeItem('token');
    console.log('token destruido')
  };
  
  onMounted(() => {
    console.log('App')
  })

</script>

<template>
    <header v-if="validateToken()" key="header">
    <!-- <header> -->
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/login" @click="handleLogout">LogOut</RouterLink>
    </header>
  
    <main>
        <RouterView :key="$route.fullPath" />
    </main>
  
    <footer>
  
    </footer>

</template>

<style scoped>
</style>