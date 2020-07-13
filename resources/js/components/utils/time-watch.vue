<template>
    <h4 class="user-item-current-hour">
        {{currentTime}}
    </h4>
</template>

<script>
import moment from 'moment-timezone';

export default {
    name:'time-watch',
    data(){
        return {
            currentTime: '--:--'
        }
    },
    props:{
        timezone:{
            type:String,
            default:null
        }
    },
    created(){
        this.updateCurrentTime(this.timezone);
        setInterval(() => this.updateCurrentTime(this.timezone), 1 * 10000);

    },
    methods:{
        updateCurrentTime(timezone) {

            if(timezone == null){
                return this.currentTime = '--:--';
            }
            //24 hours format
            // this.currentTime = moment().tz('America/New_York').format('HH mm');

            //12 hours interval
            this.currentTime = moment().tz(timezone).format('LT');
        }
    }

    
}
</script>