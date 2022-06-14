<template>
    <BreezeBranchDash>
        
        <!-- <div v-for="date in datas.index" :key="date.index">
            <p> {{ date }}</p>

             <div v-for="order in date" :key="order.id">
         <div class=" bg-white rounded p-3 m-3 shadow-sm">
             <div class="">
                  <h5 class="font-bold text-base"> Order ID ::  {{ order.id }} </h5>
                  <h3 class=" font-bold"> Sale - <span class="text-base font-light text-gray-700"> {{ order.user.name}}</span></h3>
                    <span class=" float-right text-base font-bold text-gray-700"> {{ moment(order.created_at).locale("my").format('LLL') }} </span>
             </div>
            
             <table class="w-full mt-3 p-2 text-center text-sm font-bold">
                 <thead class=" bg-indigo-600 text-white">
                     <tr>
                          <td> Name </td>
                          <td> Price</td>
                          <td> Qty</td>
                        <td> SubTotal</td>
                     </tr>
                    
                 </thead>
                 <tbody class=" border-b-2">
                     <tr v-for="item in order.orders" :key="item.id">
                         <td>  {{ item.name}} </td>
                         <td> {{ item.price}} </td>
                         <td> {{ item.quantity}} </td>
                         <td>  {{ item.subtotal}} </td>
                     </tr>
                 </tbody>
                 <tfoot>
                     <tr>
                         <td colspan="4" class="text-right ml-10"> Total : {{ order.total_amt}} </td>
                     </tr>
                 </tfoot>
             </table>
             <tbody>
                 <tr>

                 </tr>
             </tbody>

         </div>
    </div>

        </div> -->

    

    <div v-for="order in datas" :key="order.id">
         <div class=" bg-white rounded p-3 m-3 shadow-sm">
             <div class="">
                  <h5 class="font-bold text-base"> Order ID ::  {{ order.id }} </h5>
                  <h3 class=" font-bold"> Sale - <span class="text-base font-light text-gray-700"> {{ order.user.name}}</span></h3>
                    <span class=" float-right text-base font-bold text-gray-700"> {{ moment(order.created_at).locale("my").format('LLL') }} </span>
             </div>
            
             <table class="w-full mt-3 p-2 text-center text-sm font-bold">
                 <thead class=" bg-indigo-600 text-white">
                     <tr>
                          <td> Name </td>
                          <td> Price</td>
                          <td> Qty</td>
                        <td> SubTotal</td>
                     </tr>
                    
                 </thead>
                 <tbody class=" border-b-2">
                     <tr v-for="item in order.orders" :key="item.id">
                         <td>  {{ item.name}} </td>
                         <td> {{ item.price}} </td>
                         <td> {{ item.quantity}} </td>
                         <td>  {{ item.subtotal}} </td>
                     </tr>
                 </tbody>
                 <tfoot>
                     <tr>
                         <td colspan="4" class="text-right ml-10"> Total : {{ order.total_amt}} </td>
                     </tr>
                 </tfoot>
             </table>
             <tbody>
                 <tr>

                 </tr>
             </tbody>

         </div>
    </div>
    </BreezeBranchDash>
   
</template>

<script>
import BreezeBranchDash from '@/Layouts/BranchDash.vue'

import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
export default {

    components : {
        BreezeBranchDash,
        Head,
        Link,
        //moment
    },

    props: ['datas'],

   

    data() {
        return {
          moment:moment,
      
        }

      
    },

 

}
</script>

<style>

</style>