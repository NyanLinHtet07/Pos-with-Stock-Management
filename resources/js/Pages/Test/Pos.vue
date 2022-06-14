<template>
    <div>
             <div id="printMe"> 
                <p> Hello POS </p>
            </div>

            <button type="button" @click="printMe()" class="bg-gray-300 rounded px-3 py-2"> Print </button>
    </div>
   
</template>
<script>
export default {
    methods: {
        printMe() 
        {
           window.print() 
        }
    },
}
</script>