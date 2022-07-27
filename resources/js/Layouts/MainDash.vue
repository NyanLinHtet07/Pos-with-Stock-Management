<template>
    <div >
        <div class="min-h-screen bg-blue-100 flex">
            <nav class="bg-white border-b border-gray-100 w-1/6">
              
              <div class="flex justify-center p-3 mx-auto my-4">
                  <Link :href="route('dashboard')">
                        <breeze-application-logo class="" />
                    </Link>
              </div>

               <div class="px-2 border-b-2 shadow-sm flex-wrap w-full m-2">
                            <div class="font-bold text-base text-gray-700 text-center mb-3">{{ $page.props.auth.user.name }}</div>
                            <!-- <div class="font-small text-sm text-gray-500">{{ $page.props.auth.user.email }}</div> -->
                </div>
               
                     
                 

                   
                    <div class="px-2 pt-4">
                        
                         <ul class="">
                            <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    ပင်မ
                                </BreezeResponsiveNavLink>
                            </li>
    

                             <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('sale.index')" :active="route().current('sale.index')">
                                    ဈေးရောင်း
                                </BreezeResponsiveNavLink>
                            </li>

                              <!-- <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('sale.history')" :active="route().current('sale.history')" >
                                    မှတ်တမ်း
                                </BreezeResponsiveNavLink>
                            </li> -->

                             <li class="border-b-2 shadow-sm flex-wrap w-full mb-4">
                               <button class="text-gray-600 uppercase text-base px-2 py-2 rounded shadow hover:shadow-lg outline-none w-full  transition-all duration-150" type="button" v-on:click="toggleDropdown()" ref="btnDropdownRef">
                                  မှတ်တမ်း <span class="mx-4"> <i class="fas fa-sort-down"></i> </span>
                                </button>

                                <div v-bind:class="{'hidden': !dropDownMenu, 'block': dropDownMenu}" class="bg-white text-base z-50" style="min-width:12rem" ref="popoverDropdownRef" >
                                
                                     <BreezeResponsiveNavLink :href="route('report')" :active="route().current('menu.index')">
                                      လစဉ်မှတ်တမ်း
                                     </BreezeResponsiveNavLink>

                                      <BreezeResponsiveNavLink :href="route('reportYear')" :active="route().current('menu.index')">
                                     နှစ်စဉ်မှတ်တမ်း
                                     </BreezeResponsiveNavLink>





                                    <BreezeResponsiveNavLink :href="route('sale.history')" :active="route().current('sale.history')" >
                                    မှတ်တမ်း
                                    </BreezeResponsiveNavLink>
                                </div>
                                

                            </li>

                             <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('customer.index')" :active="route().current('customer.index')">
                                    ကြွေးကျန်စာရင်း
                                </BreezeResponsiveNavLink>
                            </li>

                             <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('menu.index')" :active="route().current('menu.index')">
                                    ပစ္စည်းတင်ရန်
                                </BreezeResponsiveNavLink>
                            </li>

                             <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="`/main/expense/`+ $page.props.auth.user.id" :active="route().current('expense.index')">
                                    အသုံးစရိတ်
                                </BreezeResponsiveNavLink>
                            </li>

                           

                             <li class=" border-b-2 shadow-sm flex-wrap w-full mb-4">
                                
                                <BreezeResponsiveNavLink :href="route('user.index')" :active="route().current('user.index')" class="text-white">
                                    အသုံးပြုသူများ
                                </BreezeResponsiveNavLink>
                            </li>

                            
                           
                            <li class="border-b-2 shadow-sm flex-wrap w-full mb-4">
                               
                               

                                <div class="mt-3 space-y-1">
                                    <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                        Logout
                                    </BreezeResponsiveNavLink>
                                </div>
                           
                            </li>
                        </ul>

                    </div>
                       


           
                
        </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class=" p-3 w-5/6">

                <!-- <div v-if="$page.props.flash.message" class="alert">
                    {{ $page.props.flash.message }}
                </div> -->
                <!-- <div class="border w-full p-4 bg-green-200 absolute">
                   <button class=" flex m-2 p-2 bg-white shadow-sm rounded transition-opacity delay-100 hover:bg-green-700"> Click Me</button>
                    <input type="search" name="" id="" class=" absolute inset-y-0 right-0 m-auto p-auto rounded-md shadow text-base font-light text-gray-400 cursor-text" placeholder="Text Me">
                </div> -->
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { createPopper } from "@popperjs/core"; 

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },
 
    data() {
        return {
            dropDownMenu : false
        }
    },

    methods: {
        toggleDropdown: function(){
            if(this.dropDownMenu){
                this.dropDownMenu = false;
            } else {
                this.dropDownMenu = true;
                createPopper (this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
                    placement: "bottom-start"
                });
            }
        }
    }
    
}
</script>

<style scoped>
 

  
</style>
