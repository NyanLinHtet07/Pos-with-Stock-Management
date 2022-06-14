<template>
    <Head title="Sales" />
    <BreezeBranchDash>

        <div class="w-full rounded bg-white border-red-200 shadow-md p-3 mb-10 mt-5">
            <form @submit.prevent="find">
                 <input type="text" class=" rounded flex w-full" placeholder=" ပစ္စည်းရှာရန် ..." v-model="q">

                <div class="mt-4 text-center">
                    <button class="py-2 px-3 bg-gray-400 shadow-sm rounded "> ပစ္စည်းရှာရန် </button>
                </div>

            </form>
           
            
        </div>


 <!-- <div class=" grid grid-cols-2 gap-5"> -->
     <div class="grid grid-cols-3 gap-4">
    <!-- <div v-for="item in items.data" :key="item.id" >

        <div class=" px-3 py-2 my-2 rounded-md shadow-sm bg-white flex">
            <h1 class=" font-semibold text-gray-800 my-2 text-lg "> {{ item.name}} </h1>
            <span class="  font-light text-gray-800 my-2 text-sm"> {{ item.code }} </span>
            <span class=" p-1 rounded-lg text-sm bg-green-300 text-center relative float-right"> {{ item.menu.name}} </span>
            <small class="text-gray-600 text-base font-light flex"> {{  item.note}}</small>
            <p class=" px-2 rounded text-red-900 font-bold text-md  text-center w-28 my-2"> Price : {{ item.price}} </p>
               
            <hr class="shadow-sm mb-3 bg-gray-400 border-b-2">
            <div class="text-right">
                 <button class=" px-3 py-2 bg-blue-400 hover:bg-blue-600 rounded-lg shadow-sm"> Add To Cart </button>
            </div>
           
           
        </div>

          
    </div>       -->

    <div class="col-span-2">
         <table class="table-auto mt-10 text-center px-4 w-full">
            <thead class="px-4 mb-10 bg-gray-700 text-gray-100 ">
                <tr class=" justify-around ...">
                   
                  
                    <td class="w-1/6 ..."> အမည်  </td>
                    <td class="w-1/6 ..."> အမည်ခွဲ </td>
                   
                    <td class="w-1/6 ..."> ဈေးနှုန်း </td>
                    <td class="w-1/6 ..."> Menu </td>
                    <td class="w-1/6 ..."> လက်ကျန် </td>
                    <td class="w-1/8"> ရောင်းရန် </td>
                   

                   

                </tr>
            </thead>
            <tbody class=" bg-white">
                <tr v-for="item in items.data" :key="item.id" class=" border-b-2">

                    
                  
                    <td class="text-sm font-bold">{{item.name}}</td>
                    <td class="text-sm font-bold"> {{item.code}}</td>
                   
                    <td class="text-sm font-bold">{{item.price}}</td> 
                    <td> <span class=" text-sm px-1 py-2 font-light bg-green-900 rounded shadow text-white"> {{item.menu.name}} </span></td>
                   <td class="text-sm font-bold"> {{ item.qty}}</td> 
                        <td v-if="item.qty <= 0"> 
                           <p class=" p-3 rounded-sm bg-indigo-200 text-red-900 text-sm" > None </p>
                        </td>

                        <td v-if="!(item.qty <= 0)">

                            <button class="p-3 bg-gray-500 rounded text-sm text-white font-bold shadow-sm m-2" @click="addToCart(item)"> ရောင်းရန် </button>
                            <!-- <button class="p-3 bg-blue-400" @click="removeItem(item)"> Remove </button> -->
                        </td>
                    </tr>
                    
                
            </tbody>
        </table>
    </div>

  

    
    <div class="">
            <div class="text-right">
                <button class="btn bg-indigo-400 px-2 py-1 mb-3 rounded text-white text-sm font-semibold"> {{count}} </button>
               
            </div>

            <table class=" table-auto border-1 text-center text-sm w-full">
            <thead class=" bg-indigo-800 text-white">
                <tr class=""> 
                   
                    <td class=""> အမည်  </td>
                    <td class=""> အရေအတွက် </td>
                    <td class=""> ဈေးနှုန်း </td>
                    <td class=""> ကျသင့်ငွေ </td>
                    
                </tr>
            </thead>
            <tbody class=" bg-white">
               <tr v-for="cartItem in cartItems" :key="cartItem.id" class=" border-b-2">
                <td > {{ cartItem.name}} </td>
                <td>
                    <button class=" p-2 rounded bg-gray-900" @click="addCartItem(cartItem)"> + </button> 
                        <span> {{ cartItem.quantity}} </span>
                    <button class=" p-2 rounded bg-blue-900" @click="removeCartItem(cartItem)"> - </button> 
                </td>
                <td> {{ cartItem.price}}</td>
                <td> {{ cartItem.price * cartItem.quantity}}</td>
               </tr>
               
            </tbody>
            <tfoot>
                <tr class="p-2 m-2 bg-white">
                  <td colspan="5" class="font-bold text-black border-gray-700 rounded-b text-right ml-2" > စုစုပေါင်း : {{ totalPrice}} ကျပ်  </td> 
                </tr>
                <tr>
                  <td colspan="3"> 
                     <button class="btn bg-red-800 p-2 m-3 rounded text-white" @click="clearCart(cartItems)"> ပယ်ဖျက် </button>    
                  </td>
                  <td colspan="2">
                       <button class="p-2 m-3 text- text-gray-50 font-bold rounded bg-gray-800" @click ="processPayment()"> ရောင်းမည် </button>
                  </td>
               </tr>
            </tfoot>
          
            
           

           
          
        </table>
           
             
    </div>

    
</div>

 <div class="container flex justify-center mx-auto mt-8">
                <ul class="flex">
                    <li  v-for="(link,index) in items.links" :key="index">

                       <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                      <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                      
                     
                      <!-- <Link :href="link.url === null ? '#' : link.url"  class="h-10 px-2 py-2 m-1 text-gray-200 rounded shadow-sm bg-gray-600 border-none hover:bg-gray-400" v-html="link.label" > {{link.label}} </Link> -->
                    </li>
                   
                </ul>
            </div>  

    </BreezeBranchDash>
</template>
<script>

import BreezeBranchDash from '@/Layouts/BranchDash.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        BreezeBranchDash,
        Head,
        Link
    },

    data() {
        return {
            q : this.search,
             cartElement: {},
        paymentProcessing: false,

        form: {
            qty : '',
            total:'',
            cartItem:'',
        },
           
           
          

    
        }
    },


    props: ['items', 'search'],

    methods: {
        find() {
         this.$inertia.get(`/main/sales?find=${this.q}`)
     },

     addToCart(item)
    {
        this.$store.dispatch("addToCart", item);

        localStorage.setItem('item', JSON.stringify(this.item));
    },

    removeItem(item)
    {
        this.$store.dispatch("removeItem", item);
    },

    addCartItem(cartItem){
        this.$store.dispatch("addToCart", cartItem);
    },

    removeCartItem(cartItem) {
        this.$store.dispatch("removeItem", cartItem);
    },

    clearCart(cartItems) {
        this.$store.dispatch("clearCart" , cartItems);
    },

    processPayment() {
        //send the payment information
       // this.paymentProcessing = true;

       //insert form data to data{form} 
       
            this.form.qty = this.count ;
            this.form.total = this.totalPrice;
            this.form.cartItem = JSON.stringify( this.$store.state.cartItems);
       
    if( !confirm ('ပစ္စည်းရောင်းရန်သေချာပါသလား')) return;
    this.$inertia.post('/main/submit', this.form);
    this.clearCart();

    },

    },

     computed: {
    count(){
        return this.$store.state.cartItemCount;
    },

    cartItems() {
        return this.$store.state.cartItems;

    },

    totalPrice() {
        let price = 0;
        this.$store.state.cartItems.map( el => {
            price += el["quantity"] * el["price"]
        })

        return price;
    }


}
       
       

        



        
}

  

</script>
<style>

</style>