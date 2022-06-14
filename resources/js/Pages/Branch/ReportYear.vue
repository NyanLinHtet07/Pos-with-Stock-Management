<template>
    <BreezeBranchDash>
       
       <div class=" mb-4">
           <button class="px-3 py-2 rounded bg-gradient-to-r from-gray-500 to-gray-50 drop-shadow-xl hover:shadow-xl hover:border-none" @click="openLast()" v-if="! preMonth"> ယခင်နှစ်စာရင်းကြည့်ရန်</button>
           <button class="px-3 py-2 rounded bg-gradient-to-r from-gray-50 to-gray-500 drop-shadow-xl hover:shadow-xl hover:border-none" @click="closeLast()" v-if=" preMonth"> ယခုနှစ်စာရင်းကြည့်ရန်</button>

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
                            <tr v-for=" data in yearly" :key ="data.id">
                                <td> {{ moment(data.month).format('MMM') }}</td>
                                <td> {{ data.monthlySale}}</td>
                                <td> {{ data.monthlySale - data.monthlyOrg}}</td>
                    
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ yearlySale }}</td>
                                <td> {{ yearlyProfit }}</td>
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
                            <tr v-for=" exp in yearlyExpense" :key ="exp.id">
                                <td> {{ moment(exp.monthly).format('MMM') }}</td>
                                <td> {{ exp.monthlyExp}}</td>
                              
                    
                            </tr>
                        </tbody>
                        <tfoot class="text-gray-800 text-base font-bold text-center">
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ yearlyExp }}</td> 
                            </tr>
                        </tfoot>
                 
                  </table>
            </div>
            

            <!-- show result -->

            <div class = " col-start-2 col-span-4 mt-6">
                <h1 class="text-center font-extrabold text-gray-800 mb-4">စာရင်းချုပ် </h1>
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
                            <td colspan="3"> {{ yearlySale }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> အမြတ် </td>
                            <td colspan="3"> {{ yearlyProfit}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">ထွက်ငွေ </td>
                            <td colspan="3"> {{ yearlyExp }}</td>
                        </tr>
                    </tbody>

                    <tfoot class="text-gray-800 text-base font-bold text-center">
                        <tr>
                            <td colspan="3"> စုစုပေါင်း </td>
                            <td colspan="3"> {{ yearlyTotal }}</td>
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
                            <tr v-for=" last in lastyear" :key ="last.id">
                                <td>{{ last.lastmonth}}</td>
                                <td> {{ last.lastmonthSale}}</td>
                                <td> {{ last.lastmonthSale - last.lastmonthOrg}}</td>
                    
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ lastyearSale }}</td>
                                <td> {{ lastyearProfit }}</td>
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
                            <tr v-for=" expLast in lastyearExpense" :key ="expLast.id">
                                <td> {{ expLast.lastmonthly}}</td>
                                <td> {{ expLast.lastmonthExp}}</td>
                              
                    
                            </tr>
                        </tbody>
                        <tfoot class="text-gray-800 text-base font-bold text-center">
                            <tr>
                                <td> စုစုပေါင်း </td>
                                <td> {{ lastyearExp }}</td> 
                            </tr>
                        </tfoot>
                 
                  </table>
            </div>

            <!-- show result -->

            <div class=" col-start-2 col-span-4 mt-6">
                 <h1 class="text-center font-extrabold text-gray-800 mb-4">စာရင်းချုပ် </h1>
                <table class=" table-auto bg-white rounded-md shadow-md w-full text-center">
                    <thead class="bg-gray-800 text-white font-semibold text-base text-center">
                        <tr> 
                            <td colspan="3"> အကြောင်းအရာ </td>
                            <td colspan="3"> မှတ်တမ်း </td>
                        </tr>
                    </thead>
                    <tbody class=" border-b-2 border-black">
                        <tr>
                            <td colspan="3"> ဝင်ငွေ </td>
                            <td colspan="3"> {{ lastyearSale }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> အမြတ် </td>
                            <td colspan="3"> {{ lastyearProfit }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> ထွက်ငွေ </td>
                            <td colspan="3"> {{ lastyearExp }}</td>
                        </tr>
                    </tbody>

                    <tfoot class="text-gray-800 text-base font-bold text-center">
                        <tr>
                            <td colspan="3"> စုစုပေါင်း </td>
                            <td colspan="3"> {{ lastyearTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

           
        </div>
         <!-- end  -->
       
    </BreezeBranchDash>
</template>
<script>

import BreezeBranchDash from '@/Layouts/BranchDash.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';

export default {
     components: {
        BreezeBranchDash,
        Head,
        Link,
        moment,
    },

    props: ['yearly', 'yearlyExpense', 'yearlySale', 'yearlyExp' , 'yearlyProfit', 'yearlyTotal',
            'lastyear', 'lastyearExpense', 'lastyearSale', 'lastyearExp' , 'lastyearProfit', 'lastyearTotal'],
    data() {
        return {
            preMonth : false ,
             moment:moment,
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