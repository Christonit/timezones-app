<template>

    <div class="app-container">
        <top-bar></top-bar>
        
        <div class="container">
            <div class="row py--96">
                <div class="col-12 d-flex flex-column align-items-center  text-center">
                    <img src="/img/404.svg" class="state-img mb--48"/>
                    <h2 class="hero-title ">Page not found!</h2>
                    <p class="text mb--64">The Page your are looking for does not exist</p>
                    <back-btn @click="reloadPage" alignment="center"/>
                </div>
               
            </div>
        </div>
        
       
        
    </div>
    
</template>
<script>

import TopBar from '../components/top-bar.vue';
import BackBtn from '../components/utils/buttons/back-btn.vue';
import Generals from '../mixins/gerenals.vue';

export default {

    data(){
        return {
            searchbox:true
        }
    },
    mixins:[Generals],
    components:{
        TopBar,
        BackBtn
    },
    methods:{
    }
    
}
</script>
