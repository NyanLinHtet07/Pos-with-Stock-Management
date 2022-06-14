<template>
    <Head title="Dashboard" />

    <BreezeMainDashLayout>
      

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Myint Myat Dashboard
            </h2> 
            <h1> Hello </h1>
       

        
    </BreezeMainDashLayout >
</template>

<script>
import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeMainDashLayout,
        Head,
    },
} 
</script>
<style>
   
</style>
