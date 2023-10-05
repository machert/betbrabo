<script setup>
    import { onMounted, ref } from 'vue'    
    import { login } from '@/services/login'
    import router from '@/routes'; 
    // import { useRouter } from 'vue-router';

    onMounted(() => {
        console.log('Login')
    })

    const email = ref('admin@gmail.com')
    const password = ref('1234')

    async function Logar(){
        if(!localStorage.getItem('token')){
            localStorage.removeItem('token');
        }
        const response = await login (email.value, password.value)
        if(response){
            const token = response.data.authorization.token
            console.log('sucesso ao logar token:', token)
            // document.cookie = `access_token=${token}; HttpOnly`
            localStorage.setItem('token', token);
            router.push('/')
        }else{
            console.log('erro', response)
            alert(response)
        }
    }

</script>

<template>
    <h1>Login page</h1>
    <form action="" @submit.prevent="Logar">
        <input type="email" name="email" id="email" v-model="email" />
        <input type="password" name="password" id="password" v-model="password"/>
        <button type="submit">Login</button>
    </form>
</template>


<style scoped>
</style>