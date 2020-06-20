<template>
    <div class="user-item" :class="itemType">
            <figure class="user-item-pic">
                <span class="user-img">
                    <img src="https://via.placeholder.com/32" alt="User X profile pic" >
                </span>
                <span class="user-status-dot"></span>
            </figure>
            <span v-if="viewMode == 'card'" class="user-item-info">
                <b class="user-item-name">{{name}}</b>
                <h4 class="user-item-current-hour">05:06 PM</h4>
                <span class="user-item-current-day">Wed 5th</span>
                <span class="user-item-available-time">Av: 4 AM - 5 PM</span>
            </span>
            <template v-if="viewMode == 'timeline'">
                <span class="user-item-info">

                    <b class="user-item-name">Minnie Pearson</b>
                    <span class="user-item-available-time">Av: 4 AM - 5 PM</span>

                </span>

                <h4 class="user-item-current-hour">05:06 PM</h4>
                <span class="user-item-current-day">Wed 5th</span>

            </template>

            <more-option-btn :edit-btn='true' :delete-btn='false' v-if="loggedUser"></more-option-btn>
            <more-option-btn :edit-btn='true' v-if="loggedUser == false"></more-option-btn>

        </div>
</template>

<script>
import MoreOptionBtn from "./utils/more-option-btn.vue";

export default {
    data(){
        return {

        };
    },
    components:{
        MoreOptionBtn
    },
    props:{
        loggedUser:{
            type:Boolean,
            default:false
        },
        viewMode:{
            type:String
        },
        name:{
            type:String,
            default:'Minnie Person'
        }
    },
    computed:{
        itemType(){
            if(this.viewMode == 'card'){
                return 'card';
            }
            if(this.viewMode == 'timeline'){
                return 'timeline-card';
            }
        }
    }
}
</script>