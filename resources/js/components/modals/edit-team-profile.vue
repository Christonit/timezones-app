<template>

    <modal-template width-type='slim'>

        <template>
            <h2 class="subtitle text-center mb-3">Edit Profile</h2>

            <div class="popup-fields-container">
                <div class="input-field ">
                    <label class="input-label" >Name</label>
                    <input type="text" value="Christopher Santana">
                </div>
                <div class="input-timezone">
                    <div class="input-field " @click="openPicker">
                        <label class="input-label" >Timezone</label>
                        <span class="input-timezone-text">AST +1</span>
                        <button class="btn-timezone-arrow" ref='btnArrow'></button>
                    </div>
                    <div class="timezone-picker-container" ref='timezonePicker'>
                        <span class="timezone-input-search">
                            <input type="text"  value='GMT+1'>
                        </span>
                        <span class="timezone-item" @click="selectTimezones">GMT + 1</span>
                        <span class="timezone-item" @click="selectTimezones">GMT + 2</span>
                        <span class="timezone-item" @click="selectTimezones">GMT + 3</span>
                    </div>
                    
                </div>

                <div class="time-picker-container">
                        <label class="inline-input-label">Avalability</label>
                        <time-picker></time-picker>
                            <hr/>
                        <time-picker></time-picker>

                </div>
                
                
            </div>
            <div class="w-100 ">
                <continue-btn centered="true"></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import TimePicker from '../utils/time-picker-comp.vue'
import ContinueBtn from '../utils/buttons/continue-btn';

export default {
    name: 'edit-team-profile-modal',
    components:{
        ModalTemplate,
        TimePicker,
        ContinueBtn
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
        selectTimezones(){
           let el =  this.$refs.timezonePicker;

           if(el.classList.contains('active')){
                this.$refs.btnArrow.classList.remove('active');
                el.classList.remove('active')
            }
            
        }
    }
}
</script>
