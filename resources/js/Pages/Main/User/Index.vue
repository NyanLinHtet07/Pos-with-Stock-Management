<template>
    <BreezeMainDashLayout>
         <div>

              <div class=" mt-4 mb-5 rounded-md shadow-sm text-right w-full">
                <form  @submit.prevent="find">
                    <input type="search" name="" id="" class="rounded-full text-base font-light font-white-300 border-red-200 border-1 " placeholder="အမည်ရှာရန် ..." v-model="q"> 
                    <button class="py-1 px-2 mx-2 rounded-full hover:bg-gray-500" type="search"> <span><i class="fa fa-search" aria-hidden="true"></i>
                    </span> ရှာမယ် </button>
                </form>
            </div>

             <table class="table-auto text-center w-full bg-white shadow-sm">
                 <thead class=" bg-gray-700 text-gray-100 ">
                     <tr>
                         <!-- <td class=" w-1/4 ..."> No </td> -->
                         <td class="py-2"> အမည် </td>
                         <td class="py-2"> အဆင့် </td>
                         <td class="py-2">ပြင်ဆင် </td>
                         <td class="py-2"> ပယ်ဖျက် </td>
                        
                     </tr>
                 </thead>
                 <tbody>
                     <tr v-for="user in users.data" :key="user.id" class=" border-b-2">
                        <!-- <td> {{ user.id}}</td> -->
                        <td class=" font-bold text-base py-1"> {{ user.name }}</td>
                        <td class=" font-semibold text-base text-gray-800 py-1"> {{ user.role.name}} </td>
                        <td class="py-1"> <button class="p-2 m-2 bg-green-800 rounded-full text-white" @click="editRole(user)" > <i class="far fa-edit"></i></button> </td>
                        <td class=" py-1"> <button class="p-2 m-2 bg-red-800 rounded-full text-white" @click="deleteUser(user.id)"> <i class="far fa-trash-alt"></i> </button></td>
                     </tr>

                 </tbody>
             </table>

              <!-- <div class="container flex justify-center mx-auto mt-8">
                <ul class="flex">
                    <li  v-for="(link,index) in users.links" :key="index">

                       <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                      <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                      
                     
                     
                    </li>
                   
                </ul>
            </div> -->

             <pagination class="mt-6" :links="users.links"/>

           

             <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            

                            <form @submit.prevent="updateRole(form)" class="p-4">
                                      <h1 class=" font-semibold text-lg text-red-900 mb-5"> အဆင့်သက်မှတ်ရန် </h1>
                                      
                                        
                                        <div>
                                            <input type="text" class="text-center rounded shadow mx-auto block bg-white border-none text-gray-800 font-semibold" v-model="form.name" readonly>
                                        </div>
                                        <div>
                                            <h5 class=" text-lg font-semibold text-gray-800 mb-4"> အဆင့် </h5>
                                            

                                        <div v-for="role in roles" :key="role.id" >
                                            <input type="radio" :id="role.id" :value= "role.id" v-model="form.role_id" class=" mx-5">
                                            <label :for="role.id" class=" text-sm font-light text-gray-600 my-2"> {{ role.name }}</label>
                                        </div>  
                                           
                                        </div>
                                       

                                        
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                        <button  type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                            ပြင်ဆင်
                                        </button>
                                        </span>
                                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                        
                                        <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            ပယ်ဖျက်
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
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
export default {

    components : {
        BreezeMainDashLayout,
        Head,
        Link,
        Pagination
    },

    props: ['users' , 'roles', 'search'],

    data() {
        return {
            editMode: false,
            isOpen: false,
            q: this.search,

           

            form: {
                role_id: null,
            }

      
        }

      
    },

    methods: {
        openModal(){
            this.isOpen = true;
        },

        reset(){
            this.form = {
                role_id: null,
            }
        },

        closeModal(){
            this.isOpen = false;
            this.editMode = false;
           
        },

        

        editRole(user) {
            this.form = Object.assign({}, user);
            this.editMode = true;
            this.openModal();
        },

        updateRole(user){
            user.method = 'PUT';

            this.$inertia.put(`/main/users/${user.id}/roles/update`, user );
            this.reset();
            this.closeModal();
        },

        find(){
            this.$inertia.get(`/main/users?find=${this.q}`);
        },

        deleteUser(id)
        {
            if(!confirm("ပယ်ဖျက်ရန်သေချာပါသလား")) return;
            this.$inertia.delete(`/main/users/${id}`);
        }


    },

}
</script>

<style>

</style>