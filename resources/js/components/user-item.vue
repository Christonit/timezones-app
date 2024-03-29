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
                <span class="user-img" v-if='user.avatar != null || user.avatar == ""'>
                    <img :src="user.avatar" >
                </span>
                <span class="user-img" v-else>
                    <span :style="`background-color:${color_profile}`">{{initialLetters}}</span>
                </span>
                <span class="user-status-dot" :class="isUserAvailable ? 'active':''"></span>
            </figure>
            <span v-if="viewMode == 'card'" class="user-item-info">
                <b class="user-item-name">{{username}}</b>
                <time-watch :timezone="user.timezone"></time-watch>
                <current-day :timezone="user.timezone"></current-day>
                <span class="user-item-available-time" v-if="user.member_type =='teammate'">Av: {{available_hours}}</span>
                <span class="user-item-available-time" v-else-if="user.member_type =='client'">Client</span>
                <span class="user-item-available-time" v-else>Av: {{available_hours}}</span>
            </span>
            <template v-if="viewMode == 'timeline'">
                <span class="user-item-info">
                    <b class="user-item-name">{{username}}</b>
                    <span class="user-item-available-time" v-if="user.member_type =='teammate'">Av: {{available_hours}}</span>
                    <span class="user-item-available-time" v-else-if="user.member_type =='client'">Client</span>
                    <span class="user-item-available-time" v-else>Av: {{available_hours}}</span>
                </span>

                <time-watch :timezone="user.timezone"></time-watch>
                <current-day :timezone="user.timezone"></current-day>

            </template>

            <more-option-btn mode="dark" :edit-btn='true' :delete-btn='false' v-if="loggedUser" :user-to-edit="userToEdit"></more-option-btn>
            <more-option-btn :edit-btn='true' v-if="loggedUser == false" :delete-member-btn="true" :user-to-edit="userToEdit" :resource="resource"></more-option-btn>  
        </template>     
    </div>
</template>

<script>
import moment from 'moment-timezone';
import MoreOptionBtn from "./utils/more-option-btn.vue";
import TimeWatch from "./utils/time-watch.vue";
import CurrentDay from "./utils/current-day.vue";
import generals from "../mixins/gerenals.vue";

import { mapState } from 'vuex';

export default {
    data(){
        return {
            marked_for_deletion: false,
            time: null
        };
    },
    mixins:[generals],
    created(){

        this.time = moment.tz(this.user.timezone).format('HH:mm');
        this.$emit('currentTime',moment.tz(this.user.timezone).format('HH'));   
        this.$emit('currentTeammateTime',{
            index:this.index,
            time: moment.tz(this.user.timezone).format('HH')});   

        setInterval( () => { 
            this.time =  moment.tz(this.user.timezone).format('HH:mm');
            this.$emit('currentTime', moment.tz(this.user.timezone).format('HH'));
            this.$emit('currentTeammateTime',{
            index:this.index,
            time: moment.tz(this.user.timezone).format('HH')});   
               
        }, (60 * 1000) );

    },
    mounted(){
        console.log(this.color_profile)
    },
    components:{
        MoreOptionBtn,
        TimeWatch,
        CurrentDay
    },
    props:{
        index:{
            type: [Number, String]
        },
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
        ...mapState(['screen_sizes','device_width','hour_clock']),
        color_profile(){
            if(this.index > 5) { 
                return this.color_palette[(this.index - 6)]
            }
            else if( this.index == undefined  || this.index == null){
                return this.color_palette[0]
            }
            else{ 
                return this.color_palette[this.index]
            }
        },
        username(){
            if( this.device_width < this.screen_sizes.md){
                if(this.user.name.length >= 15){
                    return `${this.user.name.substring(0,15)}...`;
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
        available_hours(){
            if(this.user.start_hour == null && this.user.end_hour == null){
                return "-- : --";
            }

            if(this.hour_clock == 12){

                let start_hour = this.user.start_hour == null ? '--' : this.user.start_hour.split(':');
                let end_hour = this.user.end_hour == null ? '--' : this.user.end_hour.split(':');
                
               
                if(start_hour[0] >= 12){


                    start_hour = start_hour != '--' ? `${(start_hour[0] - 12)}:${(start_hour[1])} PM` : 'No start';

                }else{

                    start_hour = start_hour != '--' ? `${(start_hour[0])}:${(start_hour[1])} AM` : 'No start';

                }

                if(end_hour[0] >= 12){

                    end_hour = end_hour != '--' ? `${(end_hour[0] - 12)}:${(end_hour[1])} PM` : 'No end';

                }else{
                    end_hour = end_hour != '--' ? `${(end_hour[0])}:${(end_hour[1])} AM` : 'No end';
                }

                this.user.start_hour == null ? '--' : this.user.start_hour
                return `${start_hour} - ${end_hour}`;

            }


            return `${this.user.start_hour == null ? '--' : this.user.start_hour} - ${this.user.end_hour == null ? '--' : this.user.end_hour}`;
            
        },
        isUserAvailable(){
            if(this.user.start_hour == null || this.user.end_hour == null){
                return false;
            }
            let time = this.time;
            time = time.split(':');
            time = {
                hour: parseInt(time[0]),
                minutes: parseInt(time[1])
            }

            let start_hour = this.user.start_hour.split(':');
            let end_hour = this.user.end_hour.split(':');

            start_hour = {
                hour: parseInt(start_hour[0]),
                minutes: parseInt(start_hour[1])
            }

            end_hour = {
                hour: parseInt(end_hour[0]),
                minutes: parseInt(end_hour[1])
            }

            // return {time,end_hour,start_hour};

            if( time.hour >= start_hour.hour && time.hour <= end_hour.hour ){
                
                if(time.hour == start_hour.hour && time.minutes <= start_hour.minutes){
                    return false;
                }

                if( time.hour == end_hour.hour && time.minutes >= end_hour.minutes){
                    return false
                }

                return true;

            }
            
            return false;         

        },
        userToEdit(){
            let user = this.user;
            user.key = this.index;
            return user;
        },
        initialLetters(){
            let name = this.user.name.split(" ");

            if(name.length < 2){
                return this.user.name.slice(0,2);
            }

            let abbr = [];
            
            name.forEach( letter => {

                let el = letter.slice(0,1);
                
                abbr.push(el);
            })
            return abbr.join('');

        },
        resource(){
            return {
                index: this.user.key,
                name: this.user.name,
                id: this.user.id,
                member_type: this.user.member_type,
                teammate: true}
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