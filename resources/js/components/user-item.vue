<template>
    <div class="user-item " :class="itemType + ' ' + isMarkedForDeletion" >

        <template v-if="marked_for_deletion & userId == 2">
            <span class='text'>
                “Francis Pujols” was deleted. You can still 
                <span class="text-link" @click="undoDeletion">Undo.</span>
            </span>

            <span class="time-counter">12s</span>

            <button class="material-icons modal-btn-close" @click="undoDeletion">
                close
            </button>

        </template>

        <template v-else>
            <figure class="user-item-pic">
                <span class="user-img">
                    <img v-if='avatar != null || avatar == ""' :src="avatar" >
                    <span v-else>CH</span>
                </span>
                <span class="user-status-dot"></span>
            </figure>
            <span v-if="viewMode == 'card'" class="user-item-info">
                <b class="user-item-name">{{username}}</b>
                <time-watch :timezone="timezone"></time-watch>
                <current-day :timezone="timezone"></current-day>
                <span class="user-item-available-time">Av: {{start_hour}} - {{end_hour}}</span>
            </span>
            <template v-if="viewMode == 'timeline'">
                <span class="user-item-info">

                    <b class="user-item-name">{{name}}</b>
                    <span class="user-item-available-time">Av: {{start_hour}} - {{end_hour}}</span>

                </span>

                <time-watch :timezone="timezone"></time-watch>
                <current-day :timezone="timezone"></current-day>

            </template>

            <more-option-btn mode="dark" :edit-btn='true' :delete-btn='false' v-if="loggedUser" :user-to-edit="user"></more-option-btn>
            <more-option-btn :edit-btn='true' v-if="loggedUser == false" :delete-member-btn="true" :user-to-edit="user"></more-option-btn>  
                    </template>
          
    </div>
</template>

<script>
import MoreOptionBtn from "./utils/more-option-btn.vue";
import TimeWatch from "./utils/time-watch.vue";
import CurrentDay from "./utils/current-day.vue";
import { mapState } from 'vuex';

export default {
    data(){
        return {
            marked_for_deletion: true
        };
    },
    mounted(){
    },
    components:{
        MoreOptionBtn,
        TimeWatch,
        CurrentDay
    },
    props:{
        user:{
            type:Object,
            default:()=>{
                return {};
            }
        },
        timezone:{
            type:String,
            default:null
        },
        userId:{
            type:Number,
        },
        loggedUser:{
            type:Boolean,
            default:false
        },
        viewMode:{
            type:String
        },
        name:{
            type:String,
            default:'---'
        },
        avatar:{
            type:String,
            default:null
        },
        start_hour:{
            type:String,
            default: '--'
        },
        end_hour:{
            type:String,
            default: '--'
        }

    },
    computed:{
        ...mapState(['screen_sizes','device_width']),
        username(){
            if( this.device_width < this.screen_sizes.md){
                if(this.name.length >= 16){
                    return `${this.name.substring(0,16)}...`;
                }
            }else{
                if(this.name.length > 20){
                    return `${this.name.substring(0,18)}...`;
                }
            }

            return this.name
        },
        isMarkedForDeletion(){
           return this.marked_for_deletion == true & this.userId == 2 ? 'marked-for-deletion' : '';
        },
        itemType(){
            if(this.viewMode == 'card'){
                return 'card';
            }
            if(this.viewMode == 'timeline'){
                return 'timeline-card';
            }
        }
    },
    methods:{
        undoDeletion(){
            this.marked_for_deletion = false;
        }
    }
}
</script>