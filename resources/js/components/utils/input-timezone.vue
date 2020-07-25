<template>
    <div class="input-timezone">
        <div class="input-field " @click="openPicker">
            
            <label class="input-label placeholder" 
            v-if="timezone_name == null">Timezone</label>

            <template v-else>

                <label class="input-label" >Timezone</label>
                <span class="input-timezone-text">{{timezone_name}}</span>

            </template>

            <button class="btn-timezone-arrow" ref='btnArrow'></button>
        </div>
        <div class="timezone-picker-container" ref='timezonePicker'>
            <span class="timezone-input-search">
                <input type="text"  placeholder='GMT+1' v-model="timezone_input" 
                    @keyup="searchTimezones">
            </span>
            <template v-for="item in timezones">
                <span class="timezone-item" 
                :data-timezone-id="item.id"
                @click="selectTimezones(item.name)">
                    {{item.name}}
                </span>
            </template>
        </div>
        
    </div>
</template>

<script>
import utils from '../../mixins/utils.vue';

export default {
    name:'input-timezone',
    data(){
        return {
            // currentTime: '--:--'
            
        }
    },
    mixins:[utils],
    props:{
        timezone_name:{
            type:String,
            default: null
        }
    },
    created(){
    },
    methods:{
        openPicker(e){
            let el =  this.$refs.timezonePicker;

            if(el.classList.contains('active')){
                this.$refs.btnArrow.classList.remove('active');
               return el.classList.remove('active')
            }

            this.$refs.btnArrow.classList.add('active');
            el.classList.add('active')
            e.stopPropagation();
        },
        selectTimezones(name){
            let el =  this.$refs.timezonePicker;
            let id = event.target.getAttribute('data-timezone-id');
        
            this.$emit('timezone-select',{id,name});
           
           if(el.classList.contains('active')){
                this.$refs.btnArrow.classList.remove('active');
                el.classList.remove('active')
            }
            
        }
    }  
}
</script>