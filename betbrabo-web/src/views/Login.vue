<script setup>
    import { ref } from 'vue'    
    import { login } from '@/services/login'
    import router from '@/routes'; 
    import cookie from '@/services/cookie'

    const email = ref('')
    const password = ref('')

    async function Logar(){
        cookie.reset()
        const response = await login (email.value, password.value)
        if(response){
            const token = response.data.authorization.token
            const name = response.data.user.name
            cookie.set('token', token)
            cookie.set('name', name)
            router.push('/home')
        }else{
            console.log('erro', response)
            // alert(response)
        }
    }

</script>

<template>
    <div class="flex w-full flex-col gap-2 justify-center items-center h-screen ">
        <div class="flex flex-col bg-gray-200 rounded p-4 ">
            <h1 class="flex text-2xl" >BetBrabo Login</h1>
            <form action="" @submit.prevent="Logar" class="flex flex-col gap-2 m-4">
                <div class="flex-col">
                    <label for="email" class="flex">Email</label>
                    <input type="email" name="email" id="email" 
                        v-model="email" 
                        placeholder="Email"
                        class="flex border rounded" />
                </div>
                <div class="flex-col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" 
                        v-model="password" 
                        placeholder="Password"
                        class="flex border rounded"/>
                </div>
    
                <button 
                    type="submit" 
                    class="w-full rounded h-12 px-4 font-semibold bg-blue-300 hover:bg-blue-400 active:bg-blue-500">Login</button>
            </form>

        </div>
    </div>
</template>


<style scoped>
</style>