<template>
    <BreezeMainDashLayout>

         <!-- <div class=" mt-4 rounded-md shadow-sm text-right w-full">
                <form  @submit.prevent="find">
                    <input type="search" name="" id="" class="rounded text-base font-light font-white-300 border-red-200 border-1 " placeholder="အမည်ရှာရန် ..." v-model="q"> 
                    <button class="py-1 px-2 mx-2 rounded hover:bg-gray-500" type="search"> <span><i class="fa fa-search" aria-hidden="true"></i>
                    </span> ရှာမယ် </button>
                </form>
            </div> -->

        <div>
            <button class="px-3 py-2 m-2 bg-blue-500 rounded-full shadow-sm text-white text-sm" @click="OpenModal()"> အသုံးပြုငွေထည့်ရန်</button>
        </div>
        
    
     <div class=" grid grid-cols-6  gap-3 m-3">
          
         <div v-for="userExpense in userExpenses " :key="userExpense.id" class="col-start-2 col-span-4" >
           
           <div class="rounded px-3 py-4 shadow-lg bg-white">
                <div class=" text-right">
                <button class="px-2 py-1 mx-3 my-2 rounded-full text-white bg-red-700 text-sm" @click="deleteExp(userExpense.id)"> <i class="far fa-trash-alt"></i>  </button>
            </div>
               <div>
                   <p class=""> {{moment(userExpense.created_at).locale("my").format('L')}}</p>
               </div>

              
           
                <table class="table-auto text-center mx-auto w-full">
                    <thead class="bg-blue-500">
                        <tr class=" font-bold">
                            <td> အကြောင်းအရာ </td>
                            <td> အသုံးပြုငွေ</td> 
                        </tr>
                    </thead>
                    <tbody class=" border-b-2 mb-3 border-black border-dotted">
                        <tr v-for="item in userExpense.expenses" :key="item.id" class="text-base text-gray-800 text-semibold">
                            <td> {{ item.name}}</td>
                            <td> {{ item.exp}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"> <span>စုစုပေါင်း :</span> {{ userExpense.total}} </td>
                        </tr>
                    </tfoot>
                </table>

               
            
           </div>
        </div>


        

        
     </div>

                <!-- <pagination class="mt-6" :links="userExpenses.links"/> -->

      


        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                            <h3 class="text-center m-2"> အသုံးစာရိတ် </h3>
                          <form  @submit.prevent='expense()' class="">
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  grid grid-cols-4 gap-2">
                               <input type="text" class="rounded-lg w-full border-red-300 m-3 p-3 col-span-2" placeholder=" အကြောင်းအရာ" v-model="form.name">
                                <input type="text" class="rounded-lg w-full border-red-300 m-3 p-3 col-span-2" placeholder="အသုံးပြုငွေ" v-model="form.exp">
                                 <div class=" mx-auto">
                                      <button class="btn px-2 py-1 mx-2 my-3 rounded-full shadow-md bg-gray-400" type="submit"> ထည့်သွင်း</button>
                                 </div>
                                
                          </div>
                          </form>

                          <div class="grid grid-cols-6">
                              <div class=" bg-gray p-2 rounded shadow col-start-2 col-span-4">

                                   <table class="table-auto text-center mx-auto w-full">
                                    <thead class="bg-blue-500">
                                        <tr class=" font-semibold">
                                            <td class="py-2"> အကြောင်းအရာ </td>
                                            <td class="py-2"> အသုံးပြုငွေ</td> 
                                            <td class="py-2"> ပယ်ဖျက် </td>
                                        </tr>
                                    </thead>
                                    <tbody class=" border-b-2 mb-3 border-black border-dotted">
                                        <tr v-for="(expense , index) in expenses" :key="expense.id" class="text-base text-gray-800 text-semibold">
                                            <td> {{ expense.name}}</td>
                                            <td> {{ expense.exp}}</td>
                                            <td>  <button class="btn px-2 py-1 mx-3 my-2 bg-red-700 rounded-full text-white " @click="deleteItem(index)"> Delete</button> </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right font-semibold"> <span>စုစုပေါင်း :</span> {{total}} </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                

                              </div>

                             
                          </div>

                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                              <div>
                                <ul>
                                        <li v-for="expense in expenses.data" :key="expense.index">
                                            {{ expense.name}} || {{ expense.exp}}
                                                <button class="btn p-3 m-2 bg-red-700 text-white rounded-lg" @click="deleteItem(index)"> Delete</button>
                                        </li>
                                    </ul>

                                   
                                   
                                </div>
                           
                            
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="closeModal()" type="button" class=" rounded-full border border-gray-300 px-2 py-1 mx-3 my-2 text-white bg-red-600 text-base ">
                                Cancel
                              </button>

                              <button class="rounded-full border border-gray-300 px-2 py-1 mx-3 my-2 text-white bg-blue-600 text-base " @click="store"> Upload </button>
                            </span>
                          </div>
                          
                          
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
import Pagination from '@/Components/Pagination.vue';

export default {

    components : {
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination
    
    },

props: ['userExpenses'],
  

   

    data() {
        return {
          editMode:false,
          isOpen : false,
        //    q: this.search,

          moment:moment,

          form:{
              name: '',
              exp:'',
              },

        //form: '',

          expenses:[],

      
      
        }

      
    },

    methods: {

         OpenModal(){
            this.isOpen = true;
        },

        reset()
        {
            this.form =[];
            this.expense = '';
        },

        closeModal(){
            this.isOpen = false;
            this.reset()
            this.editMode = false;

        },
        

        
      
        
        expense() 
        {
            const data = {
                name : this.form.name,
                exp: this.form.exp,
            }

           this.expenses.push(data);
           this.form = [];
        },

        deleteItem(index)
        {
            this.expenses.splice(index, 1);
        },

        store()
        { 
            

            let formsubmit = {
                    items : JSON.stringify(this.expenses),
                    total : this.total,
            };

            this.$inertia.post('/main/expenses', formsubmit);
            this.expenses = '';
            this.closeModal();
            
        },

        deleteExp(id)
        {
            if(!confirm("ပယ်ဖျက်ရန်သေချာပါသလား")) retrun;
            this.$inertia.delete(`/main/expenses/${id}`)
        },

        
        // find(){
        //     this.$inertia.get(`/main/expense/ + '$page.props.auth.user.id'?find=${this.q}`);
        // },
    },

    computed : {
        total() {

            
            if (!this.expenses) {
                return 0;
            }

            return this.expenses.reduce(function (total, expenses) {
                return total + Number(expenses.exp);
            }, 0);
        
            // return this.expenses.reduce(function(total, expenses){
            //     return total + Number(expenses.exp);
            // }, 0);
        
    }
    }

 

}
</script>

<style>

</style>