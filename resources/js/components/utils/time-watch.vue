<template>
    <h4 class="user-item-current-hour">
        {{currentTime}}
    </h4>
</template>

<script>
import moment from 'moment-timezone';
import { mapState } from 'vuex';

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
        setInterval(() => this.updateCurrentTime(this.timezone), 1 * 100);

    },
    computed:{
        ...mapState(['hour_clock'])
    },
    methods:{
        updateCurrentTime(timezone) {

            if(timezone == null){
                return this.currentTime = '--:--';
            }

            if(this.hour_clock == 12){
                this.currentTime = moment.tz(timezone).format('hh:mm A');
            }
            
            if(this.hour_clock == 24){
                this.currentTime = moment.tz(timezone).format('HH:mm');
            }
            
        }
    }

    
}
</script>