<script setup>
  import Header from './components/Header.vue'
  import { onBeforeUpdate, ref } from 'vue'
  import { RouterView} from 'vue-router'
  import router from '@/routes'; 
  import cookie from '@/services/cookie'
  
  const componentKey = ref(0);

  onBeforeUpdate(() => {
    if(!cookie.validateToken()){
      router.push('/login')
    }
    componentKey.value += 1;
  })

</script>

<template>
  <div class="flex w-full h-screen">

    <nav class="flex w-2/12 h-screen ">
      <Header :key="componentKey"/>
    </nav>

    <main class="flex w-10/12 h-screen ">
      <RouterView :key="$route.fullPath" />
    </main>
  
  </div>
</template>

<style scoped>
</style>