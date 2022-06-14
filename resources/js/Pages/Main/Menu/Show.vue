<template>
    <BreezeMainDashLayout>
        <div class="text-center">
                {{ menuShow.name}}
                <button @click="editMenu(menu)" class=" bg-green-500 hover:bg-green-800 text-gray-200 font-bold py-2 px-5 rounded" > Edit </button>
        </div>

         <div class="fixed z-10 insert-0 overflow-y-auto duration-400 border bg-gray-500 shadow-sm" v-if="isOpen">
                 <form @submit.prevent='updateMenu(form)'>
                  <input type="text" v-model= "form.name" >
                  <button class="px-6 py-2 rounded bg-gray-500 text-white" @click="closeModal()"> Close Me</button>
                    <button class="px-6 py-2 rounded bg-green-500" type="submit"> Update Data</button>
                 </form>
            </div>
    </BreezeMainDashLayout>
</template>

<script>

import BreezeMainDashLayout from "@/Layouts/MainDash.vue"
import { Head } from "@inertiajs/inertia-vue3"
import { Link } from '@inertiajs/inertia-vue3'

export default {

    components: {
        BreezeMainDashLayout,
        Head,
        Link,
    },

    props : ['menuShow'],

    data(){
        return {
             editMode:false,
            isOpen : false,
            form: { 
                name: null ,
            },

            menu: {
                name : this.menuShow.name
            }
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
     }


    
}
</script>