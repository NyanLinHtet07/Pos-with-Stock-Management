<template>
    <BreezeMainDashLayout>

         <div class=" mt-5">
                    <Link :href="route('customer.index')" class=" bg-blue-300 px-3 py-2 rounded-full shadow-sm text-gray-800 hover:bg-blue-500"> နောက်သို့</Link>
                   
                </div>
         <!-- <div v-for="customerDebit in customerDebits" :key="customerDebit.id">
             <p> {{ customerDebit.customer.name}}</p>
            <p> {{customerDebit.order.total_amt}}</p>
            
            <ul>
                <li v-for="item in customerDebit.orders" :key="item.id">
                    {{item.name}}
                </li>
            </ul>

         </div> -->

         <div v-for="customerDebit in customerDebits.data" :key="customerDebit.id">
         <div class=" bg-white rounded-2xl p-3 mx-3 my-8 shadow-lg">
             <div class="">
                  <!-- <h5 class="font-bold text-base"> ဘောက်ချာအမှတ် ::  {{ customerDebit.order.id }} </h5> -->
                  <span class="text-base font-bold text-gray-800">  {{ moment(customerDebit.created_at).locale("my").format('LLL') }} </span>
               
                  <div class="text-right">
                      <button class="px-3 py-2 rounded-full bg-red-600 text-white text-sm shadow-sm" @click="deleteDebit(customerDebit.id)"> ပယ်ဖျက်ရန် </button>
                  </div>
             </div>
            
             <table class="text-center text-sm font-bold w-full mt-3">
                 <thead class=" bg-indigo-600 text-white">
                     <tr>
                          <td class="py-2"> အမည် </td>
                         
                          <td class="py-2"> ဈေးနှုန်း </td>
                          <td class="py-2"> အရေအတွက်</td>
                        <td class="py-2"> ကျသင့်ငွေ</td>
                     </tr>
                    
                 </thead>
                 <tbody class=" border-b-2">
                     <tr v-for="item in customerDebit.orders" :key="item.id">
                         <td class="py-1">  {{ item.name}}  </td>
                      
                         <td class="py-1"> {{ item.price}} </td>
                         <td class="py-1"> {{ item.quantity}} </td>
                         <td class="py-1">  {{ item.subtotal}} </td>
                     </tr>
                 </tbody>
                 <tfoot>
                     <tr class="border-b-3 text-gray-900">
                         <td colspan="4" class="text-right ml-10 font-semibold py-1"> စုစုပေါင်း : {{ customerDebit.order.total_amt}} </td>
                     </tr>
                     <tr class="bg-gray-300">
                         <td colspan="4" class="text-right text-gray-800 font-semibold py-1"> ပေးငွေ : {{customerDebit.cash_amt}}</td>
                        
                     </tr>
                     <tr class="bg-red-200">
                          <td colspan="4" class="text-right text-red-700 font-semibold py-1"> ကြွေးကျန်  : {{customerDebit.debit_amt}}</td>
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
                    <li  v-for="(link,index) in customerDebits.links" :key="index">

                       <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                      <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                      
                     
                      
                    </li>
                   
                </ul>
            </div> -->
         <pagination class="mt-6" :links="customerDebits.links"/>

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
    },

    props: ['customerDebits'],

    data() {
        return {
            moment:moment,
          

      
        }

      
    },

    methods: {

        deleteDebit(id)
        {
            if(! confirm('ငွေရှင်းပြီးသည်မှာ သေချာပါသလား')) return;
            this.$inertia.delete(`/main/customer/debit/${id}`);
        }
       

       


    },

}
</script>

<style>

</style>