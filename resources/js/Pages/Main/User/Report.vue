<template>
    <breeze-main-dash-layout>
       
       <div class="mb-4">
           <button class="px-3 py-2 rounded bg-gradient-to-r from-gray-500 to-gray-50 drop-shadow-xl hover:shadow-xl hover:border-none" @click="openLast()" v-if="! preMonth"> ယခင်လစာရင်းကြည့်ရန်</button>
           <button class="px-3 py-2 rounded bg-gradient-to-r from-gray-50 to-gray-500 drop-shadow-xl hover:shadow-xl hover:border-none" @click="closeLast()" v-if=" preMonth">ယခုလစာရင်းကြည့်ရန် </button>

       </div>

        <div class=" grid grid-cols-6 gap-4" v-if=" ! preMonth">
            <div class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <h1 class="text-center font-bold text-gray-800 mb-4"> ဝင်ငွေစာရင်း </h1>
                  <table class=" table-auto bg-white p-3 w-full text-center">
                    <thead class="bg-blue-800 text-white text-base">
                        <tr>
                            <td> နေ့စွဲ </td>
                            <td> ဝင်ငွေ </td>
                            <td> အမြတ် </td>
                           
                        </tr>
                    </thead>
                        <tbody class="bg-white text-black border-b-2 border-black">
                            <tr v-for=" data in monthlyReport" :key ="data.id">
                                <td> {{ data.m}}</td>
                                <td> {{ data.sums}}</td>
                                <td> {{ data.sums - data.sumTotalOrg}}</td>
                    
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ monthlySale }}</td>
                                <td> {{ monthlyProfit }}</td>
                            </tr>
                        </tfoot>
                
                  </table>
            </div>

             <div class=" col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
                 <h1 class="text-center font-bold text-red-800 mb-4"> အသုံးပြုငွေစာရင်း </h1>
                  <table class=" table-auto bg-white p-3 w-full text-center">
                    <thead class="bg-red-800 text-white text-base">
                        <tr>
                            <td> နေ့စွဲ </td>
                            <td> ထွက်ငွေ  </td>
                           
                           
                        </tr>
                    </thead>
                        <tbody class="bg-white text-black border-b-2 border-black">
                            <tr v-for=" exp in monthlyExpenseReport" :key ="exp.id">
                                <td> {{ exp.month}}</td>
                                <td> {{ exp.totalExp}}</td>
                              
                    
                            </tr>
                        </tbody>
                        <tfoot class="text-gray-800 text-base font-bold text-center">
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ monthlyExpense }}</td> 
                            </tr>
                        </tfoot>
                 
                  </table>
            </div>
            

            <!-- show result -->

            <div class = " col-start-2 col-span-4 mt-6">
                <h1 class="text-center font-extrabold text-gray-800">စာရင်းချုပ် </h1>
                <table class=" table-auto bg-white rounded-md shadow-md w-full text-center">
                    <thead class=" bg-gray-800 text-white font-semibold text-base">
                        <tr> 
                            <td colspan="3"> အကြောင်းအရာ</td>
                            <td colspan="3"> မှတ်တမ်း </td>
                        </tr>
                    </thead>
                    <tbody class=" border-b-2 border-black">
                        <tr>
                            <td colspan="3"> ဝင်ငွေ </td>
                            <td colspan="3"> {{ monthlySale }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> အမြတ် </td>
                            <td colspan="3"> {{ monthlyProfit}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">ထွက်ငွေ </td>
                            <td colspan="3"> {{ monthlyExpense }}</td>
                        </tr>
                    </tbody>

                    <tfoot class="text-gray-800 text-base font-bold text-center">
                        <tr>
                            <td colspan="3"> စုစုပေါင်း </td>
                            <td colspan="3"> {{ monthlyTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- end  -->
        </div>


        <!-- for last Month Result -->
        <div class=" grid grid-cols-6 gap-2" v-if=" preMonth">
            <div class=" col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
                 <h1 class="text-center font-bold text-gray-800 mb-4"> ဝင်ငွေစာရင်း </h1>
                  <table class=" table-auto bg-white p-3 w-full text-center">
                     
                    <thead class="bg-blue-800 text-white text-base">
                        <tr>
                            <td> နေ့စွဲ </td>
                            <td> ဝင်ငွေ </td>
                            <td> အမြတ် </td>
                           
                        </tr>
                    </thead>
                        <tbody class="bg-white text-black border-b-2 border-black">
                            <tr v-for=" last in lastMonth" :key ="last.id">
                                <td> {{ last.lastMonthDate}}</td>
                                <td> {{ last.lastMonthSale}}</td>
                                <td> {{ last.lastMonthSale - last.lastMonthProfit}}</td>
                    
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ lastMonthSale }}</td>
                                <td> {{ lastMonthProfit }}</td>
                            </tr>
                        </tfoot>
                
                  </table>
            </div>

             <div class=" col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
                   <h1 class="text-center font-bold text-red-800 mb-4"> အသုံးပြုငွေစာရင်း </h1>
                  <table class=" table-auto bg-white p-3 w-full text-center">
                    <thead class="bg-red-800 text-white text-base">
                        <tr>
                            <td> နေ့စွဲ </td>
                            <td> ထွက်ငွေ  </td>
                           
                           
                        </tr>
                    </thead>
                        <tbody class="bg-white text-black border-b-2 border-black">
                            <tr v-for=" expLast in lastMonthExpense" :key ="expLast.id">
                                <td> {{ expLast.lastMonth}}</td>
                                <td> {{ expLast.lastMonthExp}}</td>
                              
                    
                            </tr>
                        </tbody>
                        <tfoot class="text-gray-800 text-base font-bold text-center">
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ lastExp }}</td> 
                            </tr>
                        </tfoot>
                 
                  </table>
            </div>

            <!-- show result -->

            <div class=" col-start-2 col-span-4 mt-6">
                 <h1 class="text-center font-extrabold text-gray-800 mb-4">စာရင်းချုပ် </h1>
                <table class=" table-auto bg-white rounded-md shadow-md w-full text-center">
                    <thead class="bg-gray-800 text-white font-semibold text-base">
                        <tr> 
                            <td colspan="3"> အကြောင်းအရာ </td>
                            <td colspan="3"> မှတ်တမ်း </td>
                        </tr>
                    </thead>
                    <tbody class=" border-b-2 border-black">
                        <tr>
                            <td colspan="3"> ဝင်ငွေ </td>
                            <td colspan="3"> {{ lastMonthSale }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> အမြတ် </td>
                            <td colspan="3"> {{ lastMonthProfit }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> ထွက်ငွေ </td>
                            <td colspan="3"> {{ lastExp }}</td>
                        </tr>
                    </tbody>

                    <tfoot class="text-gray-800 text-base font-bold text-center">
                        <tr>
                            <td colspan="3"> စုစုပေါင်း </td>
                            <td colspan="3"> {{ lastMonthTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- end  -->
        </div>
       
    </breeze-main-dash-layout>
</template>
<script>

import BreezeMainDashLayout from '@/Layouts/MainDash.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'

export default {
     components: {
        BreezeMainDashLayout,
        Head,
        Link
    },

    props: ['monthlyReport' , 'monthlyExpenseReport' , 'monthlySale', 'monthlyExpense' ,
            'monthlyProfit' , 'monthlyTotal' , 'lastMonth', 'lastMonthExpense',
            'lastMonthSale', 'lastExp','lastMonthProfit' ,'lastMonthTotal'],
    data() {
        return {
            preMonth : false ,
        }
    },

    methods: {
        openLast()
        {
            this.preMonth = true;
        },

        closeLast()
        {
            this.preMonth = false;
        }
    },
}
</script>