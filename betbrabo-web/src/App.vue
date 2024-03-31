<script setup>
  import Header from './components/Header.vue'
  import { onBeforeUpdate, ref } from 'vue'
  import { RouterView} from 'vue-router'
  import router from '@/routes'; 
  import cookie from '@/services/cookie'
  
  const componentKey = ref(0);
  const show = ref(false)

  onBeforeUpdate(() => {
    if(!cookie.validateToken()){
      router.push('/login')
      show.value = ref(false)
    }else{
      show.value = ref(true)
    }
    componentKey.value += 1;
  })


</script>

<template>
  <div class="flex w-full h-screen ">
    
    <nav class="flex w-2/12 h-screen " v-if="show.value">
      <Header :key="componentKey"/>
    </nav>

    <main class="flex h-screen bg-slate-300" :class="show.value ? 'w-10/12' : 'w-full'">
      <RouterView :key="$route.fullPath" />
    </main>
  
  </div>
</template>

<style scoped>
</style>