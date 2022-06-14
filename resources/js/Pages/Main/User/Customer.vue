<template>
    <BreezeMainDashLayout>
         <div>
             <div class=" mt-4 rounded-md shadow-sm text-right w-full ">
                <form  @submit.prevent="find">
                    <input type="search" name="" id="" class="rounded text-base font-light font-white-300 border-red-200 border-1 " placeholder="အမည်ရှာရန် ..." v-model="q"> 
                    <button class="py-1 px-2 mx-2 rounded hover:bg-gray-500 bg-gray-800 text-white" type="submit"> <span><i class="fa fa-search" aria-hidden="true"></i>
                    </span> ရှာမယ် </button>
                </form>
            </div>

             <div v-if="! isOpen" class="text-center mt-5">
                 <button class=" px-3 py-2 rounded bg-green-600 hover:bg-green-800 shadow-sm text-base text-white font-semibold" @click="openBox()"> အချက်အလက်အသစ်ထည့်ရန် </button>
             </div>
              <div class="rounded text-center w-1/2 bg-white shadow-sm p-3 m-4 mx-auto" v-if="isOpen">
                  <form @submit.prevent = "submit">

                      <div>
                            <input type="text" v-model="form.name" class=" border-red-100 rounded w-full my-2 text-base text-gray-900" placeholder="အမည်">
                      </div>

                      <div>
                           <input type="text" v-model="form.source" class=" border-red-100 rounded w-full my-2 text-base" placeholder="အချက်အလက်" >
                      </div>
                   
                         
                    
                  
                        
                   
                    <div>
                      
                        <button class=" px-3 py-2 m-2 rounded bg-gray-500 hover:bg-gray-800 text-white"> ထည့်သွင်း </button>
                          <button class=" px-3 py-2 m-2 rounded bg-red-700 text-white" @click="closeBox()"> ပယ်ဖျက် </button>

                    
                    </div>
                     
                  </form>
              </div>

                <table class="table-auto mt-10 text-center px-5 w-full bg-white mx-5 shadow-sm">
                 <thead class=" px-4 mb-10 bg-gray-700 text-gray-100 ">
                     <tr>
                        
                         <td class="w-1/6 ..."> အမည်  </td>
                         <td class="w-1/6 ..."> အချက်အလက် </td>
                         <td class="w-1/6"> ကြွေးကျန် </td>
                       
                        
                     </tr>
                 </thead>
                 <tbody>
                     <tr v-for="customer in customers.data" :key="customer.id" class=" border-b-2">
                       
                        <td> {{ customer.name }}</td>
                        <td> {{ customer.source}} </td>
                        <td> <button class="px-3 py-2 rounded bg-blue-400 shadow-sm" @click="customerDebit(customer)"> ကြည့်ရန်</button></td>
                       
                     </tr>
                 </tbody>
             </table>
        
        </div>

        <!-- <div class="container flex justify-center mx-auto mt-8">
                <ul class="flex">
                    <li  v-for="(link,index) in customers.links" :key="index">

                       <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                      <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                      
                     
                    
                    </li>
                   
                </ul>
            </div> -->

                <pagination class="mt-6" :links="customers.links"/>

    </BreezeMainDashLayout>
   
</template>

<script>
import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination.vue';
export default {

    components : {
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination,
    },

    props: ['customers'],

    data() {
        return {
            editMode: false,
            isOpen: false,
            q: this.search,

           

            form: {
                name : '',
                source: '',
            }

      
        }

      
    },

    methods: {

        openBox() {
            this.isOpen = true ;
        },

        closeBox()
        {
            this.isOpen = false;
            this.form = '';
        },
      
        submit(){
            this.$inertia.post('/main/customer', this.form);
        },

        customerDebit(customer)
        {
            this.$inertia.get(`/main/customer/${customer.id}/debit`)
        },

        find()
        {
            this.$inertia.get(`/main/customer?find=${this.q}`)
        }

       


    },

}
</script>

<style>

</style>