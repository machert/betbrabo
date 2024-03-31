<script setup>
    
    const props = defineProps({
        label: String,
    })

</script>

<template>
    <button 
        type="submit" 
        class="w-full rounded h-12 px-4 font-semibold bg-blue-300 hover:bg-blue-400 active:bg-blue-500"
        >
        {{ label }}
    </button>
</template>