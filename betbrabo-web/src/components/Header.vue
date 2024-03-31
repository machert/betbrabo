<script setup>
    import cookie from '@/services/cookie'
    import { RouterLink } from 'vue-router'
    import router from '@/routes'; 
    
    const handleLogout = () => {
        cookie.set('token', '', -1);
        cookie.set('name', '', -1);
        router.push('/login')
    };
    
</script>

<template>
    <header v-if="cookie.validateToken()" key="header" class="flex flex-col w-full">
        <RouterLink to="/home" class="p-4 hover:bg-gray-200 text-lg " >Home</RouterLink>
        <RouterLink to="/bet" class="p-4 hover:bg-gray-200 text-lg " >Bet</RouterLink>
        <RouterLink to="/login" class="p-4 hover:bg-gray-200 text-lg" @click="handleLogout">LogOut</RouterLink>
    </header>
</template>