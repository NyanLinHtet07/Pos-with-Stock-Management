<template>
    

    <BreezeMainDashLayout>

    <div>
       
     
     
           




            <div class=" mt-4 rounded-md shadow-sm text-right w-full ">
                <form  @submit.prevent="find">
                    <input type="search" name="" id="" class="rounded text-base font-light font-white-300 border-red-200 border-1 " placeholder="အမည်ရှာရန် ..." v-model="q"> 
                    <button class="py-1 px-2 mx-2 rounded-full hover:bg-gray-500" type="search"> <span><i class="fa fa-search" aria-hidden="true"></i>
                    </span> ရှာမယ် </button>
                </form>
            </div>

           <div class=" w-2/3 mx-auto my-3" v-if="message">
                <div class=" bg-green-100 px-3 py-2 rounded shadow-lg text-center font-bold text-gray-700">
                    {{ message }}
                </div>
           </div>

        
          <div class=" flex justify-start my-3">
               <a :href="route('menu.export')" class=" px-3 py-2 rounded-full bg-indigo-800 text-white mx-2"> Export Menu</a>
               <a :href="route('item.export')" class=" px-3 py-2 rounded-full bg-yellow-800 text-white mx-2"> Export Item</a>
              <form @submit.prevent="uploadExcel()" class=" px-3 py-1 rounded-full bg-blue-200">
               
                  <label for="file">Upload Excel</label>
                    <input type="file" @input="formex.file= $event.target.files [0]" class="rounded-lg p-2"/>
               
                 
                   <button class=" px-3 py-2 rounded-full shadow-lg" type="submit"> Submit</button>
              </form>
          </div>
             

            



           <div class="p-3 m-4 border-b-2 rounded-xl shadow-lg text-base bg-white ">
               <form @submit.prevent="submit()">
                  
                     <input type="text" class="w-full hover:bg-white-500 border-2 border-red-200 rounded-md font-bold text-gray-800" placeholder="Menu ရေးရန်" v-model="form.name">
                   
                  

                   <div class=" text-center content-center p-3 m-3">
                       <button type="submit" class=" bg-gray-500 hover:bg-gray-800 text-base text-white font-light py-2 px-4 rounded-full "> 
                          Menu အသစ်ထည့်ရန်</button>
                   </div>
                   
               </form>
           </div>

       

            <table class="table-auto text-center w-full">
            <thead class=" bg-gray-700 text-gray-100">
                <tr class="p-3 text-base">
                <th class=" w-1/5"> စဉ် </th>
                 <!-- <th class="w-1/4 ..."> ရက်စွဲ </th> -->

                <th class="w-1/5 py-1"> အမျိုးအမည် </th>
               
                <th class="w-1/5 py-2"> ပစ္စည်းတင်ရန် </th>
                <th class="w-1/5 py-2"> ပြင်ဆင် </th>
                <th class="w-1/5 py-2 ..."> ပယ်ဖျက် </th>
                </tr>
            </thead>
            <tbody class=" bg-white">
               <tr v-for="(menu,index) in menus.data " :key="menu.id">
                   <td class="py-2"> {{ index+1}}</td>
                 
                   <td class="py-2"> {{ menu.name}}</td>
                  
                  
                   <!-- <td> <Link :href=" '/main/menu/'+ menu.id"  class=" bg-gray-500 hover:bg-gray-800 text-gray-200 font-bold py-2 px-5 rounded"> View </Link></td> -->
                   <td class="py-2"> <Link :href="'/main/'+ menu.id +'/item'" class=" bg-gray-500 hover:bg-gray-800 text-white font-bold py-2 px-2 rounded-full" > 
                  <i class="fas fa-cloud-upload-alt"></i>
                  </Link> </td>

                   <td class="py-2"> <button @click="editMenu(menu)" class=" bg-green-500 hover:bg-green-800 text-white font-bold text-sm py-2 px-2 rounded-full" >
                    <i class="far fa-edit"></i>
                     </button></td>

                   <td class="py-2"> <button @click="deleteMenu(menu.id)" class="bg-red-500 hover:bg-red-800 text-white font-bold text-sm py-2 px-2 rounded-full">
                    <i class="far fa-trash-alt"></i>
                    </button></td>
               </tr>

             

               
            </tbody>
            </table>


    <pagination class="mt-6" :links="menus.links"/>

          


                  
    
          



           

             <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form  @submit.prevent='updateMenu(form)'>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.name">
                                   
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                           
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button  type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                          </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>

            </div>
               
        
    </BreezeMainDashLayout>
</template>

<script>
import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import Pagination from '@/Components/Pagination.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';



export default {

    
    components: { 
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination,
       // computed,
        // moment
    },

    props : ['menus','search'],

    setup() {
        const message = computed(() => usePage().props.value.success)
        return { message }
      },

    data() {
        return {
            editMode:false,
            isOpen : false,
            
            moment:moment,

            form: { 
                name: null ,
            },

            formex:{
              file:null,
            },

            q: this.search
           
        }
    },
    methods: {

        OpenModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false;
            this.reset()
            this.editMode = false;

        },
        

        reset() {
            this.form = {
                data : null,
            }
        }, 


        editMenu(menu){   
            this.form = Object.assign({}, menu);
            this.editMode = true;
            this.OpenModal();
        },

        updateMenu(menu){
            menu._method = 'PUT';

            this.$inertia.put(`/main/menu/edit/` + menu.id , menu);
            this.reset();
            this.closeModal();
        },

        uploadExcel(){
            this.$inertia.post(`/main/menu/import`, this.formex)
        },

        // async exportMenu(){
        //   await axios.get(`/main/menu/export/`);
        // },





        submit(){
          this.$inertia.post(`/main/menu`, this.form)
          this.reset();
        }, 

       

       
        deleteMenu(id){

           if(!confirm ('Are You Sure To Delete')) return ;
            this.$inertia.delete(`/main/menu/${id}`);
        },

        find(){
          this.$inertia.get(`/main/menu?find=${this.q}`)
    },

    },


    
 
    
} 
</script>