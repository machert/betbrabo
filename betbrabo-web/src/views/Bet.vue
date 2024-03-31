<script setup>
    import {onMounted, onUpdated, reactive, ref, watch } from 'vue'
    import bet from '@/services/bet'
    import Table from '@/components/Table.vue'
    import Button from '@/components/Button.vue'

    const bets = ref([])
    const bet_edit_visible = ref(false);
    const bet_edit_data = reactive({});
    const bets_view = ref([])
    const bets_view_params = reactive([{
        'page': 'bet',
    }])

    const name = ref('')
    
    // carrega as bets correspondentes ao betId
    const loadBets = async () => {
        const response = await bet.getByUsersId()
        bets.value = response.data
        bets_view.value = bets.value.map(bet => ({
            'Id': bet.id,
            'Name': bet.name,
            'Created at': moment(bet.created_at).format('DD/MM/YYYY')
        }))
    }
    
    onMounted( async () => {
        await loadBets()
    })

    function toogleModal(){
        bet_edit_visible.value = !bet_edit_visible.value;
    }
    
    function handleModal(data){
        toogleModal()
        bet_edit_data.value = bets.value.find((b) => b.id === data.Id)
        name.value = bet_edit_data.value.name
    }
    function resetModal(){
        bet_edit_data.value = null,
        toogleModal();
    }

    async function UpdateBet(){
        let data_to_be_updated = bet_edit_data.value
        data_to_be_updated.name = name.value
        const response = await bet.put(data_to_be_updated)
        if(response.status === 200){
            await loadBets()
            resetModal()
        }
    }
 
</script>

<template>
    <div class="flex flex-col w-full justify-center items-center "
        :class="{ 'bg-gray-500 bg-opacity-75 transition-opacity' : bet_edit_visible } "
    >

        <h1 class="flex text-2xl">Bet Page!</h1>
        
        <div class="w-6/12 border bg-white" >
            <Table :data="bets_view" :params="bets_view_params" @table-click="handleModal" />
        </div>

    </div>         

    <!-- bet modal -->
    <div v-if="bet_edit_visible" id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" 
        class="fixed w-full inset-0 flex items-center justify-center overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Bet {{ bet_edit_data.value?.name }}
                    </h3>
                    <button 
                        @click="toogleModal"                        
                        type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                        data-modal-hide="staticModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 flex w-full">
                    <form action="" @submit.prevent="UpdateBet" class="flex flex-col space-y-6">
                        <div class="flex flex-col">
                            <label for="name" class="text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="name" name="name" id="name" 
                                v-model="name" 
                                placeholder="Name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        </div>
                        <div class="flex">
                            <Button :label="'Atualizar'" />
                        </div>
                            
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <!-- <button data-modal-hide="staticModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                    <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button> -->
                </div>
            </div>
        </div>
    </div>
 
</template>

<style scoped>
</style>