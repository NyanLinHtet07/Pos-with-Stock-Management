<template>
 
    <BreezeMainDashLayout>
        <div>
                <div class=" mt-5">
                    <Link :href="route('menu.index')" class=" bg-blue-300 px-3 py-2 rounded-full shadow-sm hover:bg-blue-500"> နောက်သို့</Link>
                   
                </div>

                   <h1 class="text-center text-gray-900 font-bold text-2xl "> {{ menu.name}}</h1>


                <div class=" relative">
                     <div class=" text-right p-2 mt-5">
                    <form @submit.prevent="find"> 
                        <input type="search" placeholder="search...." class=" text-gray-600 text-base rounded-full border-red-200 shadow-sm" v-model="q">
                        <button class="px-3 py-2 bg-gray-700 hover:bg-gray-400 text-white shadow-sm rounded-full mx-2"> Click Me</button>
                    </form>
                    
                    </div>
             

               

                    <div v-if= '!(isOpenForm)' class="">

                    <button @click="openForm()" class="px-3 py-2 bg-blue-800 hover:bg-blue-500 rounded-full shadow-lg text-white"> ပစ္စည်းထည့်ရန် </button>

                    </div>

                </div>

                  <div class=" w-2/3 mx-auto my-3" v-if="message">
                            <div class=" bg-green-100 px-3 py-2 rounded shadow-lg text-center font-bold text-gray-700">
                                {{ message }}
                            </div>
                    </div>
                   
               

               
        <div class=" grid grid-cols-6 gap-2">

        
                <div class=" col-start-2 col-span-4 bg-purple-200 bg-transparent mt-5 rounded shadow-sm" v-if="isOpenForm">

                <div class =" mx-5 p-3">
                     <button @click="hideForm()" class=" p-1 rounded-full bg-red-700 text-white"> 
                         <i class="fa fa-times" aria-hidden="true" ></i>
                     </button>
                </div>
                    
                     <form @submit.prevent = "submit()" class=" text-center">
                 
                            <div class=" py-2 ">
                                  <input type="file" @input="form.photo= $event.target.files [0]" class="rounded-lg p-2">
                            </div>

                            <div class="py-2 mx-2 ">
                                 <input type="text" class="rounded-lg w-full border-none text-black px-2" placeholder="အမည်" v-model="form.name">
                            </div>

                            <div class=" py-2 mx-2">
                                <input type="text" class="rounded-lg w-full border-none text-black px-2" placeholder="အမည်ခွဲ" v-model="form.code">
                            </div>

                            <div class=" py-2 mx-2 ">
                                <input type="text" class="rounded-lg w-full border-none text-black px-2" placeholder="မူရင်းဈေး " v-model="form.original_price">
                            </div>

                            <div class=" py-2 mx-2 ">
                                <input type="text" class="rounded-lg w-full border-none text-black px-2" placeholder="ဈေးနှုန်း" v-model="form.price">
                            </div>

                              

                            <div class=" py-2 mx-2">
                                <input type="text" class="rounded-lg w-full border-none text-black px-2" placeholder="အရေအတွက် " v-model="form.qty">
                            </div>

                            <div class=" py-2 mx-2">
                                <textarea class="rounded-lg border-none text-black px-2 w-full" cols="18" rows="2" placeholder="မှတ်စု" v-model="form.note"></textarea>
                            </div>

                            <div class="text-right py-3 mt-3 mr-4 mb-2">
                                  <button type="submit" class="px-3 py-2 rounded-full bg-green-500 hover:bg-green-700 text-center">  ပစ္စည်းတင်မည် </button>
                            </div>
                           
                         
                       
                    </form>
                </div>

        </div>
               
               


        </div>

        <table class="table-auto mt-10 text-center px-4 w-full">
            <thead class=" bg-gray-700 text-gray-100 ">
                <tr class=" justify-around ...">
                   
                    <!-- <td class="w-1/4 ..."> Photo </td> -->
                    <td class="py-2"> အမည် </td>
                    <td class="py-2"> အမည်ခွဲ </td>
                    <!-- <td class="w-1/6 ..."> Note </td> -->
                  
                     <td class="py-2">မူရင်းဈေး </td>
                       <td class="py-2"> ရောင်းဈေး </td>
                      <td class="py-2"> အရေအတွက် </td>
                    <!-- <td class="w-1/6 ..."> Menu </td> -->
                    <td class="py-2"> ပြင်ဆင်</td>
                    <td class="py-2"> ပယ်ဖျက်</td>

                   

                </tr>
            </thead>
            <tbody class=" bg-white">
                <tr v-for="item in items.data" :key="item.id" class=" border-b-2">

                    <!-- <td v-if="item.photo === null"> <img v-bind:src= '"/photo/attachment.jpg"' alt="" class=" w-32 rounded shadow-sm px-2 text-center"> </td>
                    <td v-else><img v-bind:src= '"/upload/items/photo/" + item.photo'  alt= item.photo class="w-32 rounded shadow-sm px-2 text-center"></td>  -->
                  
                    <td class="py-1">{{item.name}}</td>
                    <td class="py-1">{{item.code}}</td>
                    <!-- <td>{{item.note}}</td> -->
                    
                    <td class="py-1"> {{item.original_price}}</td>
                    <td class="py-1">{{item.price}}</td> 
                    <td class="py-1"> {{ item.qty}}</td>
                    <!-- <td> <span class=" text-sm px-1 py-1 bg-green-500 rounded-lg text-white"> {{item.menu.name}} </span></td> -->
                    <td class="py-1"> <button @click=" editModel(item)" class=" px-3 py-2 mx-1 rounded-full text-center bg-green-600 hover:bg-green-900 text-white"> 
                          <i class="far fa-edit"></i> </button> 
                    </td>
                    <td class="py-1"> <button @click="removed(item.id)" class=" px-3 py-2 mx-1 rounded-full text-center bg-red-600 hover:bg-red-900 text-white">
                         <i class="far fa-trash-alt"></i>
                         </button>
                    </td>
                </tr>
            </tbody>
        </table> 

            <pagination class="mt-6" :links="items.links"/>

        


         <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form  @submit.prevent='updateItem(form)'>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.name">
                                   
                                  </div>

                                   <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Code:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.code">
                                   
                                  </div>

                                   <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.price">
                                   
                                  </div>

                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2"> Original Price:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.original_price">
                                   
                                  </div>

                                   <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.qty">
                                   
                                  </div>

                                   <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Note:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.note">
                                   
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                           
                            <!-- <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire.click.prevent="store()" type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                Update
                              </button>
                            </span> -->

                             <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button  type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="closeMode()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                          </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
    </BreezeMainDashLayout>
   
</template>

<script>


import BreezeMainDashLayout from "@/Layouts/MainDash.vue"
import { Head } from "@inertiajs/inertia-vue3"
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    setup(){
          const message = computed(() => usePage().props.value.success)
            return { message }
    },

    components: {
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination,
    },

    props:['menu' , 'items'],

    data(){
        return {
            // menu : {
            //      id : this.menu.id,
            //      name : this.menu.name,
            // },

            editMode : false,
            isOpen : false,
            isOpenForm : false,
            q : this.search,

            form: {
                name : null,
                photo : null,
                code : null,
                price : null,
                menu_id : this.menu.id ,
                note : null,
                original_price : null,
                qty: null,
            },

         

           
           
        }
    },

    methods : {

        openMode() {
            this.isOpen = true;

        },

        openForm() {
            this.isOpenForm = true;
        },

        hideForm() {
            this.isOpenForm = false;
        },

        closeMode() {
            this.isOpen = false;
            this.editMode = false;
            this.reset();
        },

        reset() {
            this.form = {
                 name : null,
                photo : null,
                code : null,
                price : null,
                menu_id : this.menu.id ,
                note : null,
                original_price : null,
                qty: null,
            }
        },

        submit(){
            this.$inertia.post('/main/item' , this.form);
            this.reset();

        },

        editModel(item) {
            this.form = Object.assign({}, item);
            this.editMode = true ;
            this.isOpen = true;
            },
        
        updateItem(item) {
            item.method = 'PUT';

            this.$inertia.put(`/main/item/edit/` + item.id , item);
            this.reset();
            this.closeMode();  
        },

        removed(id) {
            if(!confirm("Are You Sure To Delete")) return;
            this.$inertia.delete(`/main/item/${id}`);
        },

        find(){
            this.$inertia.get(`/main/${this.menu.id}/item?find=${this.q}`)
        },
    }

}
</script>

<style>

</style>