<template>
    <header class="top-bar">
            <div id='top-searchbar' class="input-group">
                <div class="top-searchbar-content">
                    <i class="search-icon"></i>

                    <input  class="form-control top-searchbar-input" 
                        type="text" 
                        placeholder="Employee name, New York, GTM-1, project 01"/>
                </div>

                <!-- <searchbox></searchbox> -->
            
            </div>
            <div class="view-toggle">
                <span class="grid-view view-toggle-btn"></span>
                <span class="list-view view-toggle-btn"></span>
            </div>
            
    </header>
</template>

<script>
import Searchbox from '../components/utils/searchbox.vue';

export default {
    data(){
        return {

        }
    },
    components:{
        Searchbox
    }
}
</script>