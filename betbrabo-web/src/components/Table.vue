<script setup>
    
    const props = defineProps({
        data: Array,
        params: Array,
    })

</script>

<template>
    <table class="w-full" >
        <thead>
            <tr class="border">
                <th class="border" v-for="(value, index) in data[0]" :key="index">
                    <td>{{ index }}</td>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border hover:cursor-pointer hover:bg-gray-100" 
                v-for="(row, index) in data" 
                :key="index" 
                @click="$emit('tableClick', row)" >                
                <td class="border" v-for="value in row " :key="value">
                    {{ value }}
                </td>
            </tr>
        </tbody>
    </table>
</template>