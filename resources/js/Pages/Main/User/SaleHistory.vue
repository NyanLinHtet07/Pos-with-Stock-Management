<template>
    <BreezeMainDashLayout>
        
     <div class="grid grid-cols-6 gap-4">
        <div v-for="user in users" :key="user.id" class=" col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2">
           
            <div class="  bg-white rounded shadow-sm p-3 m-3 text-center">
                <p class=" font-light text-gray-800 mb-10"> {{user.name}}</p>
                <button class="btn p-3 m-2 rounded bg-green-900 text-white" @click="viewHistory(user)"> View Details</button>
            </div>
        </div>
     </div>

    
    </BreezeMainDashLayout>
   
</template>

<script>
import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
export default {

    components : {
        BreezeMainDashLayout,
        Head,
        Link,
        //moment
    },

    props: ['users'],

   

    data() {
        return {
          moment:moment,
      
        }

      
    },

    methods: {
        viewHistory(user)
        {
            this.$inertia.get(`/main/sales/${user.id}`);
        }
    },
 

}
</script>

<style>

</style>