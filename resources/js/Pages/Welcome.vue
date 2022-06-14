<template>
    <Head title="MyintMyat" />

    <div class="relative  items-top justify-center  bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            
               
                        <div class=" header  shadow-xl z-20">

                        
                                    <div class=" w-full h-26 text-center p-4 bg-indigo-100">
                                        <h2 class=" font-bold text-red-900 sm:text-sm md:text-md lg:text-2xl xl:text-2xl logo"> မြင့်မြတ် </h2>
                                        <p class=" font-semibold text-md text-gray-800 my-2 ">  ကားပစ္စည်းနှင့်အင်ဂျင်ဝိုင်အမျိုးမျိုး </p>
                                        <p class="font-bold text-sm text-gray-900 my-2 font-sans"> Since - 2000 </p>
                                    </div>

                                    <nav class="flex text-center bg-indigo-600 ">
                                            <div class=" flex-1">
                                                <Link href="#home"> <button class="px-3 py-2 rounded  text-white font-semibold  filter drop-shadow-sm w-full active:bg-indigo-300 hover:bg-indigo-300"> ပင်မ </button> </Link>
                                            </div>
                                            <div class=" flex-1">
                                                <Link href="#search"> <button class="px-3 py-2 rounded  text-white font-semibold  filter drop-shadow-sm w-full active:bg-indigo-300 hover:bg-indigo-300"> ပစ္စည်းရှာရန် </button> </Link>
                                            </div>
                                            <div class=" flex-1">
                                              <Link href="#contact"> <button class="px-3 py-2 rounded  text-white font-semibold filter drop-shadow-sm w-full active:bg-indigo-300 hover:bg-indigo-300"> ဆက်သွယ်ရန် </button> </Link>
                                            </div>
                                    </nav>

                        </div>

               
            
                        <div class ="main z-0"> 

                            <div class=" w-auto mb-5" id="home">
                            
                              

                                        <!-- <div class=" flex-1 ">
                                            <p class="p-3 bg-gray-500">07</p>
                                        </div> -->
                                        <div class=" relative">
                                            <img :src="'/photo/1.jpg'" class=" bg-cover bg-center bg-no-repeat rounded-md sepia-0" alt=""> 
                                      
                                           
                                        </div>

                                      
                             
                                 
                                  

                            </div>

                            <div class=" grid grid-cols-6 pt-10  mt-10 bg-indigo-100 items-center" id="search">
                                <div class=" col-start-2 col-span-4 border-b-2 border-gray-300">
                                    <h3 class="text-center text-gray-700 font-bold mb-6"> ပစ္စည်းအမည်ရှာဖွေရန် </h3>
                                      <form  @submit.prevent="find">
                                        <input type="text" class=" w-full rounded drop-shadow-md" placeholder=" အမည်ရှာရန် ... " v-model="q">

                                        <div class="text-center my-5">
                                             <button class="py-2 px-3 rounded shadow-lg bg-gray-700 text-white hover:bg-gray-50 hover:text-gray-700 hover:shadow-xl"> ရှာမယ် </button>
                                        </div>

                                        <span class="text-sm text-green-900 mb-5"> *ပစ္စည်းရှိမရှိသိရှိနိုင်ရန် အသုံးပြုသူကိုယ်တိုင်အလွယ်တကူရှာဖွေကြည့်နိုင်ပါသည်</span>
                                       
                                    </form>
                                </div>
                                <div class=" col-span-6">
                                     <table class="table-auto text-center px-4 w-full p-7 rounded shadow-2xl">
                                        <thead class="px-4 mb-10 bg-gray-700 text-gray-100 ">
                                            <tr class=" justify-around text-sm p-2">
                                            
                                            
                                                <td class=""> အမည်  </td>
                                                <td class=""> အမည်ခွဲ </td>
                                            
                                                <!-- <td class=""> ဈေးနှုန်း </td> -->
                                                <td class=""> Menu </td>
                                                <!-- <td class=""> လက်ကျန် </td> -->
                                              
                                            

                                            

                                            </tr>
                                        </thead>
                                        <tbody class=" bg-white">
                                            <tr v-for="item in items" :key="item.id" class=" border-b-2">

                                                
                                            
                                                <td class="text-sm font-bold">{{item.name}}</td>
                                                <td class="text-sm font-bold"> {{item.code}}</td>
                                            
                                                <!-- <td class="text-sm font-bold">{{item.price}}</td>  -->
                                                <td> <span class=" text-xs p-1 font-light bg-green-900 rounded shadow text-white"> {{item.menu.name}} </span></td>
                                                
                                                    <!-- <td v-if="item.qty <= 0"> 
                                                    <p class=" p-3 rounded-sm bg-red-100 text-red-900 text-sm" > လက်ကျန်ကုန်နေပါသည် </p>
                                                    </td>

                                                    <td v-if="!(item.qty <= 0)">

                                                        <p class=" p-3 rounded-sm bg-indigo-100 text-gray-800 text-sm" > ပစ္စည်းလက်ကျန်ရှိပါသည် </p>
                                                       
                                                    </td> -->
                                                </tr>
                                                
                                            
                                        </tbody>
                                    </table>
                                     <!-- <pagination class="mt-6" :links="items.links"/> -->
                                </div>
                                 
                            </div>

                            <!-- <div class=" grid grid-cols-6  mt-10 h-screen md:h-screen bg-yellow-100 items-center">
                                <div class=" col-start-2 col-span-4">
                                    <h3 class=" text-gray-700 font-bold"> Notice</h3>

                                     <h3 class=" text-gray-700 font-bold text-right"> History</h3>
                                    
                                     <h3 class=" text-gray-700 font-bold"> iform</h3>

                                  
                                </div>
                            </div> -->

                             <div class=" bg-gray-200 pt-10 mb-6" id="contact">
                               
                                    <h1 class=" text-gray-700 font-bold text-center my-6 text-3xl font-serif"> ဆက်သွယ်ရန်</h1>

                                    <div class=" grid grid-cols-6 gap-2 h-screen px-3 py-2 ">

                                         <div class=" col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 rounded ">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d601.1176451722488!2d96.15879878983769!3d16.932291495294056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c191495a7eb7e9%3A0x22028384b7f68d4d!2z4YCZ4YC84YCE4YC64YC34YCZ4YC84YCQ4YC6!5e0!3m2!1smy!2smm!4v1641488287852!5m2!1smy!2smm" 
                                                 class=" shadow-2xl w-full h-72 mx-auto border-none rounded-lg p-2"
                                                    allowfullscreen="" loading="lazy">
                                                </iframe>  
                                        </div>

                                    <div class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 rounded">
                                        <div class=" my-3 w-96 mx-auto ">
                                            <h3 class=" font-serif font-semibold text-gray-800 m-7 text-left text-xl"> ဆက်သွယ်ရန်ဖုန်းနံပါတ်များ </h3>
                                            <ul class=" list-inside inline items-center">
                                                <a href="tel:+9595099498"> 
                                                    <li class=" border-l-2 border-blue-400 pl-9 my-3 hover: py-2 hover:px-3 hover:rounded-md hover:bg-gray-500 hover:text-gray-50 hover:shodow-lg w-7/12"> <i class="fas fa-tty text-lg text-gray-700 mr-5"></i>   09-5099498 </li>
                                                </a>

                                                <a href="tel:+959799255903">
                                                  <li class=" border-l-2 border-blue-400 pl-9 my-3 hover: py-2 hover:px-3 hover:rounded hover:bg-gray-500 hover:text-gray-50 hover:shodow-lg w-7/12"> <i class="fas fa-phone-square-alt text-lg text-gray-700 mr-5"></i>  09-798255903 </li>
                                                </a>

                                                <a href="tel:+959440306261">
                                                    <li class=" border-l-2 border-blue-400 pl-9 my-3 hover: py-2 hover:px-3 hover:rounded hover:bg-gray-500 hover:text-gray-50 hover:shodow-lg w-7/12"> <i class="fas fa-phone-square-alt text-lg text-gray-700 mr-5"></i>  09-440306261 </li>
                                                </a>
                                            </ul>

                                            <small class=" text-red-600 text-xs p-3"> * ဖုန်းနံပါတ်အားနှိပ်ကာတိုက်ရိုက်ဖုန်းခေါ်ဆိုနိုင်ပါသည် </small>

                                            
                                        </div>

                                         <div class=" my-3 px-3 w-full mx-auto">
                                                <h4 class=" text-gray-700 font-serif text-lg"> <i class="fas fa-home text-lg text-gray-700 mr-5"></i> လိပ်စာ</h4>
                                                <small class="text-base subpixel-antialiased mr-6 text-gray-700 font-semibold text-center"> - ဈ/10 - 11၊ ဒဂုံလမ်း၊ အောင်မင်္ဂလာအဝေးပြေးဝင်း၊ မင်္ဂလာဒုံ </small>
                                            </div>

                                       

                                    </div>

                                    </div>

                                   
                                     
                              
                                  
                                
                            </div>

                            

                            <footer class=" pt-10 mt-5">

                                  <div class=" px-3 py-2 my-2 rounded-xl shadow-2xl bg-white w-2/3 h-auto mx-auto">
                                        <h3 class=" text-center text-lg text-gray-700"> <i class="fas fa-info-circle"></i> </h3>
                                     <blockquote class=" bg-gray-50 text-base font-sans font-bold text-gray-600 text-center">
                                               မြင့်မြတ်ကားပစ္စည်းဆိုင်ကို ၂၀၀၀ ခုနှစ်မှစတင်တည်ထောင်ကာ
                                                 နှစ်ပေါင်း ၂၀ ကြာအောင်ခိုင်မာစွာ ရပ်တည်လာနိုင်သော ကားပစ္စည်းဆိုင်ဖြစ်ပါသည်
                                            </blockquote>
                                </div>
                                

                                <div class=" w-full text-center bg-indigo-400 py-4">
                                    <h2 class=" font-bold text-red-900 sm:text-sm md:text-md lg:text-2xl xl:text-2xl logo"> မြင့်မြတ် </h2>
                                        <p class=" font-semibold text-md text-gray-800 my-2 ">  ကားပစ္စည်းနှင့်အင်ဂျင်ဝိုင်အမျိုးမျိုး </p>
                                        <p class="font-bold text-sm text-gray-900 my-2 font-sans"> Since - 2002 </p>
                                </div>

                              <!-- <div class="text-right text-sm font-mono font-semibold">
                                     <a href="nyanlinhtet.com"> Powered By  Nyan Lin Htet </a>
                                </div> -->
                                
                            </footer>

                           
                        </div>
                                    
                    
            
                   
        

           
      
    </div>
</template>



<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';

//  import VueSlickCarousel from 'vue-slick-carousel'
//   import 'vue-slick-carousel/dist/vue-slick-carousel.css'
//   // optional style for arrows & dots
//   import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

// const VueSlickCarousel = require ('vue-slick-carousel');

export default {
    components: {
      Head,
      Link,
      Pagination,
      
    },

props: ['items'],

data() {
    return {
          q: this.search,
    }
},

methods: {
    find(){
            this.$inertia.get(`/?find=${this.q}`);
        },
},
   
}
</script>

<style>

    html {
        scroll-behavior: smooth;
    }

    .logo {
        
        text-shadow: 1px 1px 0 yellow;
       
    }

    .header{
        
        overflow: hidden;
        background-color: #333;
        position: fixed;
        top: 0;
        width: 100%;

    }

    .main {
        padding: 16px;
         margin-top: 120px;
    }
</style>
