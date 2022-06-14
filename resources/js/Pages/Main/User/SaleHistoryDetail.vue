<template>
    <BreezeMainDashLayout>
        
     <div>
                    <Link :href="route('sale.history')" class=" bg-blue-300 px-3 py-2 rounded shadow-sm hover:bg-blue-500"> နောက်သို့</Link>
                   
                </div>

    <div v-for="order in datas" :key="order.id">
         <div class=" bg-white rounded p-3 mx-3 my-8 shadow-sm">
             <div class="">
                  <h5 class="font-bold text-base"> Order ID ::  {{ order.id }} </h5>
                  <h3 class=" font-bold"> ရောင်းသူ - <span class="text-base font-light text-gray-700"> {{ order.user.name}}</span></h3>
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

     <!-- <div class="container flex justify-center mx-auto mt-8">
                <ul class="flex">
                    <li  v-for="(link,index) in datas.links" :key="index">

                       <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                      <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                      
                     
                      
                    </li>
                   
                </ul>
            </div> -->

             <!-- <pagination class="mt-6" :links="datas.links"/> -->
    </BreezeMainDashLayout>
   
</template>

<script>
import BreezeMainDashLayout from '@/Layouts/MainDash.vue'

import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import Pagination from '@/Components/Pagination.vue';
export default {

    components : {
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination,
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