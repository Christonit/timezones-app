<template>

    <div style="height: 100%;
                width: 100%;
                position: fixed;
                top: 0;
                bottom: 0;
                display: flex;
                align-items:center;
                background-color: #f8fbfb;
                z-index:9999;
                align-items: center;">
        
        <div class="container">
            <div class="row py--96">
                <div class="col-12 d-flex flex-column align-items-center  text-center">
                    <img src="/img/404.svg" class="state-img mb--48"/>
                    <h2 class="hero-title mb--32">Sorry, this app doesn't have a mobile version yet.</h2>
                    <p class="text ">Please use switch to a devise at least 1024px wide.</p>
                </div>
               
            </div>
        </div>
        
       
        
    </div>
    
</template>
<script>

import Generals from '../mixins/gerenals.vue';

export default {
    name: "mobile-not-available",
    data(){
        return {
            searchbox:true
        }
    },
    mixins:[Generals],
    components:{
    },
    methods:{
    }
    
}
</script>
