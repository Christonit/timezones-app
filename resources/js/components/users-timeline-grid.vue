<template>
    <div class="timeline-grid">
        <div class="timeline-items">
            <div class="timeline-header">
                <user-item view-mode='timeline' class="" :user="user">
                </user-item>
            </div>
            <user-item v-for="(member,key) in team_members" :user="member" :key='key' :index="key" view-mode='timeline'></user-item>
        </div>

        <div class="hours-items-grid">

            <span class="timeline-arrow">
                <img src="../../img/arrow-tip.svg" alt="" class="arrow-tip"/>
                <i class="arrow-line"></i>
            </span> 
            

            <div class="timeline-header">

                <div class="hour-timeframe">
                    <span class="hour-time" v-for="(hour,key) in hour_counter_24"
                    :class="startOrEnd24({hour: hour,
                        start_time: user.start_hour,
                        end_time: user.end_hour})" v-if="hour_clock == 24"> {{ (hour == '') ? '00' : hour}}</span>
                    
                    <span class="hour-time" v-for="(hour,key) in hour_counter_12"
                    :class="startOrEnd12({original: hour.original,
                        time: hour.time,
                        meridie: hour.meridie,
                        start_time: user.start_hour,
                        end_time: user.end_hour})"
                    v-if="hour_clock == 12">{{hour.time}}</span>
                    
                </div>

            </div> 

            <div v-for="(member,key) in team_members" :key='key' class="hour-timeframe">
                <!-- {{member.name}} -->
                <span class="hour-time" v-for="(hour,key) in hour_counter_24"
                    :class="startOrEnd24({hour: hour,
                        start_time: member.start_hour,
                        end_time: member.end_hour})" v-if="hour_clock == 24"> {{ (hour == '') ? '00' : hour}}</span>
                  
                <span class="hour-time" v-for="(hour,key) in hour_counter_12"
                    :class="startOrEnd12({original: hour.original,
                        time: hour.time,
                        meridie: hour.meridie,
                        start_time: member.start_hour,
                        end_time: member.end_hour})"
                    v-if="hour_clock == 12">{{hour.time}}</span>

            </div>
        
        </div>

    </div>
</template>
<script>

import UserItem from './user-item.vue';
import { mapState, mapGetters } from 'vuex';

export default {
    data(){
        return {
            numbers:[1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        }
    },
    components:{
        UserItem
    },
    computed:{
        ...mapState(['user','hour_clock']),
        ...mapGetters(['team_members']),
         hour_counter_24(){
            return ['00',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,'00',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
        },
         hour_counter_12(){
            return [
                {original:0,time:12,meridie:'am'},
                {original:1,time:1,meridie:'am'},
                {original:2,time:2,meridie:'am'},
                {original:3,time:3,meridie:'am'},
                {original:4,time:4,meridie:'am'},
                {original:5,time:5,meridie:'am'},
                {original:6,time:6,meridie:'am'},
                {original:7,time:7,meridie:'am'},
                {original:8,time:8,meridie:'am'},
                {original:9,time:9,meridie:'am'},
                {original:10,time:10,meridie:'am'},
                {original:11,time:11,meridie:'am'},
                {original:12,time:12,meridie:'pm'},
                {original:13,time:1,meridie:'pm'},
                {original:14,time:2,meridie:'pm'},
                {original:15,time:3,meridie:'pm'},
                {original:16,time:4,meridie:'pm'},
                {original:17,time:5,meridie:'pm'},
                {original:18,time:6,meridie:'pm'},
                {original:19,time:7,meridie:'pm'},
                {original:20,time:8,meridie:'pm'},
                {original:21,time:9,meridie:'pm'},
                {original:22,time:10,meridie:'pm'},
                {original:23,time:11,meridie:'pm'},
                {original:1,time:1,meridie:'am'},
                {original:2,time:2,meridie:'am'},
                {original:3,time:3,meridie:'am'},
                {original:4,time:4,meridie:'am'},
                {original:5,time:5,meridie:'am'},
                {original:6,time:6,meridie:'am'},
                {original:7,time:7,meridie:'am'},
                {original:8,time:8,meridie:'am'},
                {original:9,time:9,meridie:'am'},
                {original:10,time:10,meridie:'am'},
                {original:11,time:11,meridie:'am'},
                {original:12,time:12,meridie:'pm'},
                {original:13,time:1,meridie:'pm'},
                {original:14,time:2,meridie:'pm'},
                {original:15,time:3,meridie:'pm'},
                {original:16,time:4,meridie:'pm'},
                {original:17,time:5,meridie:'pm'},
                {original:18,time:6,meridie:'pm'},
                {original:19,time:7,meridie:'pm'},
                {original:20,time:8,meridie:'pm'},
                {original:21,time:9,meridie:'pm'},
                {original:22,time:10,meridie:'pm'},
                {original:23,time:11,meridie:'pm'}
            ];
        }

    },
    methods:{
        available_hour( start_hour, end_hour){

            let start = start_hour.split(":");
            let end = end_hour.split(":");

            return {
                start:{
                hour: parseInt(start[0]),
                minutes: parseInt(start[1])},
                end:{
                hour: parseInt(end[0]),
                minutes: parseInt(end[1])}
            }
        },
        startOrEnd24({hour,start_time,end_time}){


            let available_hour = this.available_hour(start_time,end_time);
            let start = {};
            let end = {};
            start.hour = available_hour.start.hour;
            end.hour = available_hour.end.hour;
            start.minutes = available_hour.start.minutes;
            end.minutes = available_hour.end.minutes;

            if(hour >= start.hour && hour <= end.hour){

                if(hour == start.hour){
                    if(start.minutes > 0){
                        return "available half entry";
                    }
                    return "available entry";
                }

                if(end.minutes > 0  && hour == end.hour ){
                    return "available half leave";
                }else if( end.minutes == 0  && hour == (end.hour - 1) ){
                     return "available leave";
                }else if(hour == end.hour){
                    return ""
                }

                return 'available';
            }
            
        },
        startOrEnd12({original,time,meridie,start_time,end_time}){

            let available_hour = this.available_hour(start_time,end_time);

            let start = {};
            let end = {};
            start.hour = available_hour.start.hour;
            end.hour = available_hour.end.hour;
            start.minutes = available_hour.start.minutes;
            end.minutes = available_hour.end.minutes;

            if(original >= start.hour && original <= end.hour){

                if(original == start.hour){
                    if(start.minutes > 0){
                        return "available half entry";
                    }
                    return "available entry";
                }

                if(end.minutes > 0  && original == end.hour ){
                    return "available half leave";
                }else if( end.minutes == 0  && original == (end.hour - 1) ){
                     return "available leave";
                }else if(original == end.hour){
                    return ""
                }

                return 'available';

            }
            
        }
    }
}
</script>