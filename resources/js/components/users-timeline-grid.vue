<template>
    <div class="timeline-grid">
        <div class="timeline-items">
            <div class="timeline-header" >
                <user-item
                id="logged-user"
                view-mode="timeline"
                class=""
                :user="user"
                @currentTime="current_time = $event"></user-item>
            </div>
            <user-item
                v-for="(member, key) in team_members"
                :user="member"
                :key="key"
                :index="key"
                @currentTeammateTime="teammates_current_time[$event.index] = $event.time"
                view-mode="timeline"></user-item>
        </div>

        <div class="hours-items-grid">
            <span class="timeline-arrow">
                <img src="../../img/arrow-tip.svg" alt="" class="arrow-tip" />
                <i class="arrow-line"></i>
            </span>

            <div class="timeline-header">
                <div id="logged-user-timeframe" class="hour-timeframe">

                    <template v-if="hour_clock == 24" v-for="(hour, key) in hour_counter_24">
                        <span class="hour-time"
                        :class=" startOrEnd24({
                        hour: hour,
                        start_time: user.start_hour,
                        end_time: user.end_hour})"
                        :data-time="hour">
                        {{ hour == "" ? "00" : hour }}</span>
                    </template>
                
                    <template v-for="(hour, key) in hour_counter_12" v-if="hour_clock == 12">
                        <span class="hour-time"
                        :class="startOrEnd12({
                        original: hour.original,
                        time: hour.time,
                        meridie: hour.meridie,
                        start_time: user.start_hour,
                        end_time: user.end_hour})"
                        :data-time="hour.time+hour.meridie">{{ hour.time }}</span>
                    </template>

                    
                </div>
            </div>

            <div v-for="(member, key) in team_members"
                :key="key" :data-teammate="member.id" class="hour-timeframe">
                <span
                class="hour-time"
                v-for="(hour, key) in hour_counter_24"
                :class="
                startOrEnd24({
                    hour: hour,
                    start_time: member.start_hour,
                    end_time: member.end_hour}) "
                :data-time="hour"
                v-if="hour_clock == 24">
                {{ hour == "" ? "00" : hour }}</span>
                <span
                class="hour-time"
                v-for="(hour, key) in hour_counter_12"
                :class="
                    startOrEnd12({
                        original: hour.original,
                        time: hour.time,
                        meridie: hour.meridie,
                        start_time: member.start_hour,
                        end_time: member.end_hour
                    })"
                :data-time="hour.time+hour.meridie"
                v-if="hour_clock == 12">{{ hour.time }}</span>
            </div>
        </div>
    </div>
</template>
<script>
import UserItem from "./user-item.vue";
import { mapState, mapGetters } from "vuex";

export default {
    data() {
        return {
            numbers: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            current_time: null,
            current_hour_timeframe:null,
            teammates_current_time: [],
            hour_counter_24:["00", 1, 2, 3,4, 5,6,7,8, 9, 10,11,12,13,14,15,16,17,18, 19,20,21,22, 23,
                "00", 1, 2, 3,4, 5,6,7,8, 9, 10,11,12,13,14,15,16,17,18, 19,20,21,22, 23],
            hour_counter_12:[
            { original: 0, time: 12, meridie: "pm" },{ original: 1, time: 1, meridie: "am" },{ original: 2, time: 2, meridie: "am" },{ original: 3, time: 3, meridie: "am" },{ original: 4, time: 4, meridie: "am" },{ original: 5, time: 5, meridie: "am" },
            { original: 6, time: 6, meridie: "am" },{ original: 7, time: 7, meridie: "am" },{ original: 8, time: 8, meridie: "am" },{ original: 9, time: 9, meridie: "am" },
            { original: 10, time: 10, meridie: "am" },{ original: 11, time: 11, meridie: "am" },{ original: 12, time: 12, meridie: "am" },
            { original: 13, time: 1, meridie: "pm" },{ original: 14, time: 2, meridie: "pm" },{ original: 15, time: 3, meridie: "pm" },
            { original: 16, time: 4, meridie: "pm" },{ original: 17, time: 5, meridie: "pm" },{ original: 18, time: 6, meridie: "pm" },{ original: 19, time: 7, meridie: "pm" },
            { original: 20, time: 8, meridie: "pm" },{ original: 21, time: 9, meridie: "pm" },{ original: 22, time: 10, meridie: "pm" },{ original: 23, time: 11, meridie: "pm" },
            { original: 0, time: 12, meridie: "pm" },{ original: 1, time: 1, meridie: "am" },{ original: 2, time: 2, meridie: "am" },{ original: 3, time: 3, meridie: "am" },
            { original: 4, time: 4, meridie: "am" },{ original: 5, time: 5, meridie: "am" },{ original: 6, time: 6, meridie: "am" },
            { original: 7, time: 7, meridie: "am" },{ original: 8, time: 8, meridie: "am" },{ original: 9, time: 9, meridie: "am" },
            { original: 10, time: 10, meridie: "am" },{ original: 11, time: 11, meridie: "am" },{ original: 12, time: 12, meridie: "am" },
            { original: 13, time: 1, meridie: "pm" },{ original: 14, time: 2, meridie: "pm" },{ original: 15, time: 3, meridie: "pm" },
            { original: 16, time: 4, meridie: "pm" },{ original: 17, time: 5, meridie: "pm" },{ original: 18, time: 6, meridie: "pm" },
            { original: 19, time: 7, meridie: "pm" },{ original: 20, time: 8, meridie: "pm" },{ original: 21, time: 9, meridie: "pm" },
            { original: 22, time: 10, meridie: "pm" },{ original: 23, time: 11, meridie: "pm" }]

        };
    },
    mounted(){
        this.setCurrentTarget();
        this.moveTimeRuler();
        let int = setInterval( ()=>{
            this.setCurrentTarget();
            this.moveTimeRuler();
            clearInterval(int);
        },100)

        setInterval( ()=>{
            this.setCurrentTarget();
            this.moveTimeRuler();
        }, 180 * 1000)
    },
    components: {
        UserItem
    },
    computed: {
        ...mapState(["user", "hour_clock"]),
        ...mapGetters(["team_members"]),
        current_hour(){
            if(this.current_time != null){

                let hour = this.current_time;

                if(this.hour_clock == 12){
                    if(hour < 10){ 
                        hour = hour.split("")[1];
                    }

                    hour = {
                        hour: (hour > 12 ? (hour - 12) : hour),
                        meridie: (hour > 12 ? 'pm':'am')}

                    if(hour.hour == "0"){
                        hour.hour = 12;
                        hour.meridie = "pm";
                    }
                    
                    return `${  hour.hour }${hour.meridie}`;
                }

                return hour;
            }

            return false;
            
        },
        teammates_current_hour(){
            if(this.teammates_current_time.length > 0){
                let arr = [];

                if(this.hour_clock == 12){
                    
                    this.teammates_current_time.forEach(hour => {
                        let el = hour;
                        let obj = null;
                        if(el < 10){ 
                            el = hour.split("")[1];
                        }

                        obj = el;
                        obj = {
                            hour: (el > 12 ? (el - 12) : el),
                            meridie: (el > 12 ? 'pm':'am')}

                        if(obj.hour == "0"){
                            obj.hour = 12;
                            obj.meridie = "pm";
                        }
                        
                        arr.push(`${  obj.hour }${obj.meridie}`);

                    })
                    
                }else{

                    this.teammates_current_time.forEach(hour => {
                        arr.push(hour);
                    })

                }

                return arr;
            }

            return teammates_current_hour;
            
        }

    },
    methods: {
        setCurrentTarget(){
            let current_hour_timeframe = document.querySelector("#logged-user-timeframe .available[data-time='"+this.current_hour+"']");
            if(current_hour_timeframe == undefined){
                    current_hour_timeframe = document.querySelector(`#logged-user-timeframe .hour-time.available.leave ~ .hour-time[data-time~='${this.current_hour}']`)
            }
            this.current_hour_timeframe = current_hour_timeframe;
        },
        moveTimeRuler(){
            let current_hour =  this.current_hour_timeframe;
            let current_hour_pos =  current_hour.offsetLeft;
            let arrow = document.querySelector(".timeline-arrow").offsetLeft;
            let timeframe_ruler = document.querySelector("#logged-user-timeframe");
            let teammates_rulers = [];
            let position = null;
            let hour_counter_12 = this.hour_counter_12;
            let hour_counter_24 = this.hour_counter_24;
            let calculation = (arrow - current_hour_pos - 6);

            if(current_hour_pos < arrow){

                if(this.hour_counter_12.length < 52){
                    let new_12 = [{ original: 20, time: 8, meridie: "pm" },{ original: 21, time: 9, meridie: "pm" },{ original: 22, time: 10, meridie: "pm" },{ original: 23, time: 11, meridie: "pm" }];
                    let new_24 = this.hour_counter_24.splice(35);
                    
                    new_12.reverse().map( item => {
                        this.hour_counter_12.unshift(item);
                    } )
                }
            }

            this.team_members.forEach(member => {
                let timeframe = document.querySelector(`.hour-timeframe[data-teammate="${member.id}"]`);
                teammates_rulers.push(timeframe)

            })
           
            teammates_rulers.forEach( (ruler,key) => {

                let nodes = ruler.children;

                let hour_dom_node = document.querySelector(`.hour-timeframe[data-teammate="${key + 1}"] .available.hour-time[data-time="${this.teammates_current_hour[key]}"]`)
                
                if(hour_dom_node == null){
                    hour_dom_node = document.querySelector(`.hour-timeframe[data-teammate="${key + 1}"] .hour-time.available.leave ~ .hour-time[data-time="${this.teammates_current_hour[key]}"]`)
                }

                position = hour_dom_node.offsetLeft
                calculation = (arrow - position - 6);
                ruler.style.left = `${calculation}px`;
            })

        },
        available_hour(start_hour, end_hour) {
            let start = start_hour.split(":");
            let end = end_hour.split(":");

            return {
                start: {
                    hour: parseInt(start[0]),
                    minutes: parseInt(start[1])
                },
                end: {
                    hour: parseInt(end[0]),
                    minutes: parseInt(end[1])
                }
            };
        },
        startOrEnd24({ hour, start_time, end_time }) {
            if(start_time == null || end_time == null){
                return ""
            }
            let available_hour = this.available_hour(start_time, end_time);
            let start = {};
            let end = {};
            start.hour = available_hour.start.hour;
            end.hour = available_hour.end.hour;
            start.minutes = available_hour.start.minutes;
            end.minutes = available_hour.end.minutes;

            if (hour >= start.hour && hour <= end.hour) {
                if (hour == start.hour) {
                    if (start.minutes > 0) {
                        return "available half entry";
                    }
                    return "available entry";
                }

                if (end.minutes > 0 && hour == end.hour) {
                    return "available half leave";
                } else if (end.minutes == 0 && hour == end.hour - 1) {
                    return "available leave";
                } else if (hour == end.hour) {
                    return "";
                }

                return "available";
            }
        },
        startOrEnd12({ original, time, meridie, start_time, end_time }) {
             if(start_time == null || end_time == null){
                return ""
            }
            let available_hour = this.available_hour(start_time, end_time);

            let start = {};
            let end = {};
            start.hour = available_hour.start.hour;
            end.hour = available_hour.end.hour;
            start.minutes = available_hour.start.minutes;
            end.minutes = available_hour.end.minutes;

            if (original >= start.hour && original <= end.hour) {
                if (original == start.hour) {
                    if (start.minutes > 0) {
                        return "available half entry";
                    }

                    
                    return "available entry";
                }

                if (end.minutes > 0 && original == end.hour) {
                    return "available half leave";
                } else if (end.minutes == 0 && original == end.hour - 1) {
                    return "available leave";
                } else if (original == end.hour) {
                    return "";
                }

                return "available";
            }
        }
    }
};
</script>
