<script setup>
    import router from '@/routes'; 
    import {onMounted} from 'vue'
    
    const token = localStorage.getItem('token');
    // if(!token){
    //     router.push('/login')
    // }
    
    onMounted(() => {
        console.log('Home')
    })
    
</script>

<template>
    <h1>Home page</h1>
</template>

<style scoped>
</style>