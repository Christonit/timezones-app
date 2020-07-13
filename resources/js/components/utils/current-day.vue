<template>
    <span class="user-item-current-day">{{current_day}}</span>
</template>

<script>
import moment from 'moment-timezone';

export default {
    name:'current-day',
    data(){
        return {
            current_day: '---'
        }
    },
    props:{
        timezone:{
            type:String,
            default:null
        }
    },
    created(){
        this.updateCurrentDay(this.timezone);
        setInterval(() => this.updateCurrentDay(this.timezone), 1 * 10000);

    },
    methods:{
        updateCurrentDay(timezone) {

            if(timezone == null){
                return this.current_day = '---';
            }

            this.current_day = moment().tz(timezone).format('ddd Do');
        
        }
    }

    
}
</script>