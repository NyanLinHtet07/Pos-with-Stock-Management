<template>
    <BreezeBranchDash>
         <div class=" grid grid-cols-6 gap-2">
                <div class="bg-white rounded shadow p-3 m-5  col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2">
                    <p class="text-lg text-gray-700 font-bold mb-8"> ယနေ့စာရင်းချုပ် </p>
                    <div class=" text-4xl my-7 text-gray-800 text-center"> <i class="fas fa-chart-line"></i> </div>
                        <div class="text-lg text-gray-700 shadow-md p-3 mt-5 bg-gray-100 rounded"> 
                            <p class="text-base font-bold text-green-900 p-2"> ရောင်းရငွေ - {{ salePrice}} ကျပ် </p>
                            
                        <p class="text-base font-semibold text-green-500 p-2"> အမြတ်ငွေ - {{ profit}} ကျပ် </p>
                        <p class="text-base font-bold text-red-800 p-2">အသုံးစရိတ် - {{ userExpense}} ကျပ် </p>
                        <p class=" text-indigo-600 text-base font-bold p-2">စာရင်းချုပ် -  ( {{ dailyResult}} ) ကျပ် </p>

                        </div>

                    <!-- <div class="text-right">
                        <button class=" px-3 py-2 rounded bg-gray-800 text-white shadow" @click="submit()"> Click Me </button>
                    </div> -->


                </div>




           <div class="bg-white rounded shadow p-3 m-5 col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2">
               <p class="text-lg text-blue-1500 font-bold mb-8"> တစ်ပတ်စာစာရင်းချုပ် </p>
               <span class=" text-4xl my-7 text-blue-800 text-center"><i class="fas fa-chart-pie"></i></span>
                <div class="text-lg text-blue-700 shadow-md p-3 mt-5 bg-blue-100 rounded">
                    <p class="text-base font-bold text-green-900 p-2">ရောင်းရငွေ - {{ weeklySale }} </p>
                    <p  class="text-base font-semibold text-green-500 p-2">အမြတ်ငွေ - {{ weeklyProfit}} </p>
                    <p class="text-base font-bold text-red-800 p-2">အသုံးစရိတ် - {{ weeklyExpense }}</p>
                    <p class=" text-indigo-600 text-base font-bold p-2">စာရင်းချုပ် - {{  weeklyResult}}</p>
                 </div>
           </div>

            
            <div class="bg-white rounded shadow p-3 m-5 col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2">
            <Link :href="route('report')">
               <p class="text-lg text-blue-500 font-bold mb-8"> Sales Report </p>
              
               <span class=" text-4xl my-7 text-blue-800"><i class="fas fa-chart-pie"></i></span>
                <div class="text-lg text-blue-700 shadow-md p-3 mt-5 bg-blue-300 rounded">
                   View Monthly Report
                    <p class="text-sm text-blue-800 font-sm mb-3">ရောင်းရငွေ -  {{ month}} </p>
                    <p class="text-sm text-blue-800 font-sm mb-3">အမြတ်ငွေ -  {{ monthlyProfit}} </p>
                    <p class="text-sm text-blue-800 font-sm mb-3">အသုံးစရိတ် -  {{ monthlyExpense}} </p>
                    <p class="text-sm text-blue-800 font-sm mb-3">စာရင်းချုပ် -  {{ monthlyReport}} </p>
                 </div>
           </Link>
           </div>
           

            </div>
            <div class=" grid grid-cols-3 gap-2">
                <div class=" bg-white rounded shadow  p-3 m-2 text-center">
                    <p class="text-lg text-green-900 font-bold mb-8"> Profits</p>
                     <span class=" text-4xl my-7 text-green-800"><i class="fas fa-money-bill-wave"></i></span>
                     <p class="text-lg text-green-700 shadow-md p-3 mt-5 bg-green-300 rounded"> {{ profit}} ks </p>
                </div>


           
            <Link :href="route('sale.index')">
                <div class=" bg-white rounded shadow  p-3 m-2 text-center ">
                    <div class=" mt-6">
                        <span class=" text-4xl my-9 text-indigo-700"> <i class="fas fa-cart-plus"></i> </span>
                        <h3 class="text-lg text-indigo-600 font-bold my-9"> စျေးရောင်း </h3>
                    </div>
                </div>

            </Link>

             <Link :href="route('sale.index')">
                <div class=" bg-white rounded shadow  p-3 m-2 text-center ">
                    <div class=" mt-6">
                        <span class=" text-4xl my-9 text-red-600"> <i class="fas fa-history"></i> </span>
                        <h3 class="text-lg text-red-700 font-bold my-9"> မှတ်တမ်း </h3>
                    </div>
                </div>

            </Link>

                
            </div>
            
    </BreezeBranchDash>
</template>]
<script>

    import BreezeBranchDash from '@/Layouts/BranchDash.vue'
    import {Head} from '@inertiajs/inertia-vue3';
    import {Link} from '@inertiajs/inertia-vue3'

export default{
    components: {
        BreezeBranchDash, 
        Head,
        Link
    },

     props:[ 'profit', 'salePrice', 'userExpense', 
            'dailyResult' , 
            'weeklySale','weeklyProfit', 'weeklyExpense', 'weeklyResult' ,
            'month' , 'monthlyProfit','monthlyExpense', 'monthlyReport'],

}
</script>