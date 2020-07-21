<template>
    <div class="user-item " :class="itemType + ' ' + isMarkedForDeletion" >

        <template v-if="marked_for_deletion">
            <span class='text'>
                “{{user.name}}” was deleted. You can still 
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
                    <img v-if='user.avatar != null || user.avatar == ""' :src="user.avatar" >
                    <span v-else :style="`background-color:${$randomColor({luminosity:'dark'})}`">{{initialLetters}}</span>
                </span>
                <span class="user-status-dot"></span>
            </figure>
            <span v-if="viewMode == 'card'" class="user-item-info">
                <b class="user-item-name">{{username}}</b>
                <time-watch :timezone="user.timezone"></time-watch>
                <current-day :timezone="user.timezone"></current-day>
                <span class="user-item-available-time">Av: {{user.start_hour}} - {{user.end_hour}}</span>
            </span>
            <template v-if="viewMode == 'timeline'">
                <span class="user-item-info">

                    <b class="user-item-name">{{username}}</b>
                    <span class="user-item-available-time">Av: {{user.start_hour}} - {{user.end_hour}}</span>

                </span>

                <time-watch :timezone="user.timezone"></time-watch>
                <current-day :timezone="user.timezone"></current-day>

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
            marked_for_deletion: false
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
        loggedUser:{
            type:Boolean,
            default:false
        },
        viewMode:{
            type:String
        }
    },
    computed:{
        ...mapState(['screen_sizes','device_width']),
        username(){
            if( this.device_width < this.screen_sizes.md){
                if(this.user.name.length >= 16){
                    return `${this.user.name.substring(0,16)}...`;
                }
            }else{
                if(this.user.name.length > 20 & this.viewMode == "card"){
                    return `${this.user.name.substring(0,18)}...`;
                }
                if(this.user.name.length > 14 & this.viewMode == "timeline"){
                    return `${this.user.name.substring(0,14)}...`;
                }
            }

            return this.user.name
        },
        initialLetters(){
            let name = this.user.name.split(" ");

            if(name.length > 1){
                return name.slice(0,2);
            }else{
                let abbr = [];
                
                name.forEach( letter => {

                    let el = letter.slice(0,1);
                   

                    abbr.push(el);
                })

                return abbr.join();

            }
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