<template>

    <BreezeMainDashLayout>

        <div class=" my-6">
            <form @submit.prevent="find" class=" flex">
                 <input type="text" class=" rounded-full mx-3 w-full px-3 shadow-lg" placeholder=" ပစ္စည်းရှာရန် ..." v-model="q">

                <div class="text-center">
                    <button class="py-2 px-3 bg-green-500 shadow-sm rounded-full text-white hover:bg-gray-800 transition-transform ease-in "> ပစ္စည်းရှာရန် </button>
                </div>

            </form>
           
            
        </div>



     <div class="grid grid-cols-6 gap-3 mx-auto ">


    <div class="col-span-4  md:col-span-6 lg:col-span-3 xl:col-span-3">
         <table class="table-auto mt-10 text-center px-4 w-full rounded-lg drop-shadow-md">
            <thead class="px-4 mb-10 bg-gray-700 text-gray-100 ">
                <tr class=" justify-around text-sm p-2">
                   
                  
                    <td class=" py-2"> အမည်  </td>
                    <td class=" my-2"> အမည်ခွဲ </td>
                   
                    <td class=" my-2"> ဈေးနှုန်း </td>
                    <td class=" my-2"> Menu </td>
                    <td class="my-2"> လက်ကျန် </td>
                    <td class=" my-2"> ရောင်းရန် </td>
                   

                   

                </tr>
            </thead>
            <tbody class=" bg-white">
                <tr v-for="item in items" :key="item.id" class=" border-b-2">

                    
                  
                    <td class="text-sm font-bold">{{item.name}}</td>
                    <td class="text-sm font-bold"> {{item.code}}</td>
                   
                    <td class="text-sm font-bold">{{item.price}}</td> 

                    <!-- Need to fixed -->
                    <td> <span class=" text-xs px-2 py-1 font-medium bg-indigo-600 rounded-full shadow-sm text-white "> {{item.menu.name}} </span></td>
                  
                   <td class="text-sm font-bold"> {{ item.qty}}</td> 
                        <td v-if="item.qty <= 0"> 
                           <p class=" px-2 py-1 rounded-full bg-indigo-100 text-red-900 text-sm" > Out of Stock </p>
                        </td>

                        <td v-if="!(item.qty <= 0)">

                            <button class="px-2 py-1 bg-green-700 rounded-full text-sm text-white font-semibold shadow-sm m-2" @click="addToCart(item)"> ရောင်းရန် </button>
                            <!-- <button class="p-3 bg-blue-400" @click="removeItem(item)"> Remove </button> -->
                        </td>
                    </tr>
                    
                
            </tbody>
        </table>

       

             <!-- <pagination class="mt-6" :links="items.links"/> -->
            
    </div>

    

  

    
    <div class="col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
            <div class="text-right">
                <button class="btn bg-indigo-400 px-2 py-1 mb-3 rounded-xl text-white text-sm font-semibold"> {{count}} </button>
               
            </div>

            <table class=" table-fixed border-1 text-center text-sm w-full">
            <thead class=" bg-indigo-800 text-white">
                <tr class=""> 
                   
                    <td class="py-2"> အမည်  </td>
                    <td class="py-2"> အရေအတွက် </td>
                    <td class="py-2"> ဈေးနှုန်း </td>
                    <td class="py-2"> ကျသင့်ငွေ </td>
                    
                </tr>
            </thead>
            <tbody class=" bg-white">
               <tr v-for="cartItem in cartItems" :key="cartItem.id" class=" border-b-2">
                <td > {{ cartItem.name}} <br> <small class="text-sm text-gray-600">{{ cartItem.code}} </small> </td>
                <td>
                    <button class=" p-2 bg-red-900 text-white rounded-xl shadow-sm border-none mx-1" @click="removeCartItem(cartItem)"> - </button> 
                        <span> {{ cartItem.quantity}} </span>
                   
                     <button class=" p-2 bg-green-700 text-white rounded-xl shadow-sm border-none mx-1" @click="addCartItem(cartItem)"> + </button> 
                </td>
                <td> {{ cartItem.price}}</td>
                <td> {{ cartItem.price * cartItem.quantity}}</td>
               </tr>
               
            </tbody>
            <tfoot class=" foot">
                <tr class="p-2 m-2 bg-white">
                  <td colspan="4" class="font-bold text-black border-gray-700 rounded-b text-right ml-2" > စုစုပေါင်း : {{ totalPrice}}  ကျပ်  </td> 
                </tr>
                <tr>
                  <td colspan="2"> 
                     <button class="btn bg-red-800 p-2 mx-1 rounded-full text-white" @click="clearCart(cartItems)"> ပယ်ဖျက် </button>    
                  </td>
                  <td colspan="2">
                       <button class="p-2 m-1 text-gray-50 font-bold rounded-full bg-green-800" @click ="processPayment()"> ရောင်းမည် </button>
                  </td>
               </tr>
            </tfoot>
          
            
           

           
          
        </table>

        

        <div v-if=" ! debitForm" class="text-right mb-2 mt-4">
            <button class="px-3 py-2 rounded-full bg-gray-700 text-gray-100" @click="openDebitForm()"> ကြွေကျန်စာရင်းမှတ်ရန် </button>
        </div>

        <div class="rounded bg-white text-base" v-if="debitForm" >
            <div class="grid grid-cols-6 gap-4">
                 <div class="col-start-1 col-end-3 text-right">
                      <button class="px-2 py-1 rounded-full bg-gray-700 text-white mt-2" @click="openCusForm()"> <i class="far fa-user-circle"></i></button>
                </div>

                 <div class="col-end-7 col-span-2">
                   
                     <button class="px-2 py-1 rounded-full bg-red-900 text-white mt-2" @click="closeDebitForm()"> <i class="fas fa-times"></i> </button>
                </div>
            </div>
                

               

                 

                

                 <div v-if="cusForm">
              
                <form @submit.prevent ="uploadCustomer()" class="text-center mt-3">
                    <div class="text-center">
                        <input type="text" v-model="customerForm.name" class="rounded border-red-300 border-2 p-3 m-2 shadow-sm" placeholder="အမည်">
                    </div>
                     <div class="text-center">
                        <input type="text" v-model="customerForm.source" class="rounded border-red-300 border-2 p-3 m-2 shadow-sm" placeholder="အချက်အလက်">
                    </div>

                     <button class="px-3 py-2 rounded shadow-sm text-white bg-red-700 mx-2" @click="closeCusForm()"> Cancel </button>
                    <button class="px-3 py-2 rounded shadow-sm text-white bg-gray-700 mx-2"> Submit</button>
                </form>
            </div>

          
            <div class=" overflow-scroll h-40">
                 <div v-for="customer in customers" :key="customer.id" class="mt-3 " >
                     <input type="radio" :id="customer.id" :value= "customer.id" v-model="form.cus_id" class=" mx-2">
                    <label :for="customer.id" class=" text-sm font-light text-gray-600 my-2"> {{ customer.name }} ( {{ customer.source}} )</label>
                </div> 
            </div>
                

                <div class="mt-5 p-3">
                     <div class="text-center">
                    <label for="" class="mx-2"> ပေးငွေ </label>
                    <input type="number" v-model="form.cash" class="rounded border-red-300 border-2 px-2 shadow-sm" placeholder="Cash">
                      </div>
               
                        <div class="text-right m-3 p-2 bg-red-100">
                                <h2 class="text-red-600 font-bold">ကြွေးကျန် :  {{ debut }}</h2>
                        </div>        
                </div>
                  

        </div>


        <!-- for recipt form -->

        <div class="reciept invisible" id="print" >
            
                    <!-- <div class="header">
                        
                            <span id="sub" > ကားပစ္စည်းနှင့်အင်ဂျင်ဝိုင်အမျိုးမျိုး </span>
                            
                             <span class="address"> ဈ/10 - 11၊ ဒဂုံလမ်း၊ အောင်မင်္ဂလာအဝေးပြေးဝင်း၊ မင်္ဂလာဒုံ </span>
                             <p id="ph"> 095099498 , 09798255903 , 094430306261 </p> 
                    </div> -->

                     <div class="header">
                        
                            <span id="sub" > ကုန်စုံဆိုင် </span>
                            
                             <span class="address"> ဈ/9 ၊ ဒဂုံလမ်း၊ အောင်မင်္ဂလာအဝေးပြေးဝင်း၊ မင်္ဂလာဒုံ </span>
                             <p id="ph"> 09443114645 </p> 
                    </div>
                
                   
                      
                    

                    <div>
                         <p class="time">{{ currentDate() }} </p>
                        
                        
                         <table class="printtable"   >
                            <thead >
                                <tr class="table-header"> 
                                
                                    <td class=""> အမည်  </td>
                                    <td class=""> အရေအတွက် </td>
                                  
                                    <td class=""> ကျသင့်ငွေ </td>
                                    
                                </tr>
                            </thead>
                            <tbody class=" table-body">
                            <tr v-for="cartItem in cartItems" :key="cartItem.id" class=" border-b-2">
                                <td > {{ cartItem.name}} <br> <small class="code">{{ cartItem.code}} </small> </td>
                                <td>
                                
                                        <span class="time">{{ cartItem.price}} * {{ cartItem.quantity}}  </span>
                                
                                </td>
                              
                                <td> {{ cartItem.price * cartItem.quantity}}</td>
                            </tr>
                            
                            </tbody>
                            <tfoot class="text">
                                <tr class="p-2 m-2 bg-white">
                                    <td colspan="5" > စုစုပေါင်း : {{ totalPrice}}  ကျပ်  </td>
                                </tr>
 
                                
                                <tr class="p-2 m-2" v-if="this.form.cus_id">
                                    <td colspan="5" class="" > ပေးငွေ : {{ form.cash}}  ကျပ်  </td>  
                                </tr>

                                <tr class="p-2 m-2" v-if="this.form.cus_id">
                                    <td colspan="5" class="" > ကြွေးကျန် : {{ debut}}  ကျပ်  </td> 
                                </tr>
                                 
                                 
                                
                            
                            </tfoot>
                        
                        
                        
                        </table>

                        
                        <div class= " break">
                          
                           <br>

                           
                        </div>
                    </div>
            
        </div>

           
             
    </div>

    

    

    
    
</div>

     


    </BreezeMainDashLayout>
</template>
<script>

import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import print from 'print-js';
import Pagination from '@/Components/Pagination.vue';







export default {
    components: {
        BreezeMainDashLayout,
        Link,
        Pagination,
    },

    data() {
        return {
            q : this.search,
             cartElement: {},
        paymentProcessing: false,
        cusForm: false,
        debitForm: false,
        rcp: false,
        moment : moment,
        printJs : print,

        form: {
            qty : '',
            total:'',
            totalOrg:'',
            cartItem:'',
            cus_id : '',
            cash:'',
            debut:'',
        },

        customerForm: {
            name:'',
            source:'',
        },

        
           
           
          

    
        }
    },


    props: ['items', 'search', 'customers'],

    methods: {

       

        print() {
                //    print({
                //     printable: 'print', 
                //     type: 'html', 
                //     style: ' @media print {#print{ max-width:80 mm; min-width:55mm;} .header{ width:100%; text-align:center; margin: 20px; padding: auto; line-height: 150%;} .title { font-size:30px !important; font-weight: bold;}  #sub { font-size:8px !important; } .time { font-size:6px !important; font-weight: light; margin-top:10px;} .printtable { border: 1px solid black; font-size:small;   border-collapse: collapse; width:100%;  } .printtable th , td { font-size:10px; text-align:center; padding:10px;  } tfoot td { text-align: right} .address{ text-align-center; font-size:8px ;} .table-body{ border-bottom: 2px dashed black;}}',
                // });
                // },

                
                const style =
                    "@page { margin-top: 50px ; } @media print { #print{ font-weight:light;} h1{ color: black; text-align: center; margin-top:10px; padding-top:20px; border-top:1px dashed black;} .header{text-align:center; margin: 20px; padding: auto; line-height: 150%;} #sub { font-size:14px; display:block;} .address { font-size:12px; display:block;} #ph{ font-size:11px; padding:5px; margin:0px;} .time{ font-size:12px;}  .printtable { text-align:center; margin-left:auto;margin-right:auto; padding:0;  border-top: 1px solid black; border-collapse: collapse;  word-break: break-all;} .printtable td { font-size:12px; font-weight: normal; padding:5px;  } .code{font-size:10px; font-weight:lighter; padding:3px;} tfoot td { text-align: right} .address{ text-align-center; font-size:12px ;} .table-body{border-bottom : 1px dashed black}  .foot{ margin-top: 20px;} .break { margin-top:60px; border-top: 2px solid black;}  }";
                     const headerStyle = "font-weight: 100;";
                print({
                    printable: "print",
                    type: "html",
                    //header: " မြင့်မြတ်",
                    header: " မိသားစု ",
                    headerStyle: headerStyle,
                    style: style,
                    scanStyles: false,
                    onPrintDialogClose: () => console.log("The print dialog was closed"),
                    onError: e => console.log(e)
                });
                },
               
  
        
           
    

        currentDate(){
            const current = new Date();
            const date = current.getFullYear() + '-' + (current.getMonth(), 1) +'-'+ current.getDate();
            const time = current.getHours() +":"+current.getMinutes() +":"+ current.getSeconds();
            const datetime = date +' '+ time;

            return datetime;

        },

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

    resetForm() {
        this.form = {  
            cus_id :'',
            cash: '', 
            debut: '',
        }
    },

    processPayment() {
        //send the payment information
       // this.paymentProcessing = true;

       //insert form data to data{form} 
       
            this.form.qty = this.count ;
            this.form.total = this.totalPrice;
            this.form.totalOrg = this.totalOrgPrice;
            this.form.cartItem = JSON.stringify( this.$store.state.cartItems);

            this.form.debut = this.debut;
       

    if( !confirm ('ပစ္စည်းရောင်းရန်သေချာပါသလား')) return;
    
    
    this.$inertia.post('/main/submit', 
         this.form 
        );
   
    this.clearCart();
    this.resetForm();
    this.print();

    

    },

    //for customer data null

    reset() {
        this.customerForm = {
            name:null,
            source:null,
        }
    },

    //for customer data upload

    uploadCustomer()
    {
        this.$inertia.post('/main/customer', this.customerForm);
        this.reset();
        this.closeCusForm();
    },

    //open n close Customer Form

    openCusForm()
    {
        this.cusForm = true;
    },

    closeCusForm()
    {
        this.cusForm = false;
    },

    // end

    // open n close Debit Form

    openDebitForm()
    {
        this.debitForm = true;
    },

    closeDebitForm()
    {
        this.debitForm = false;
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
    },

    totalOrgPrice(){
        let orgPrice = 0;
        this.$store.state.cartItems.map( el => {
            orgPrice += el["quantity"] * el["original_price"]
        })

        return orgPrice;
    },

    debut() {
        
        return this.totalPrice - this.form.cash ;

    }



    


}

       
       

        



        
}

  

</script>

<style scoped>

        @media print {
            .reciept {
       
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        min-width: auto;
        background: #fff;

        
    }

    .header {
        text-align: center;
        font-weight: bold;
        margin: 20px;
        padding: auto;
        font-size: 10px;
    }

   
    .time {
        color: black;
        font-weight: bold;
        font-size: 12px;

    }
        }

        .reciept {
       
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        min-width: auto;
        background: #fff;

        
    }

    .header {
        text-align: center;
        font-weight: bold;
        margin: 20px;
        padding: auto;
    }

    .header p {
        font-size: 12px;
    }

    .time {
        color: black;
        font-weight: bold;
        font-size: 12px;

    }
      


    

    


</style>