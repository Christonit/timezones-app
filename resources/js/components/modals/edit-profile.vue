<template>

    <modal-template modal_name="edit-info" width-type='slim'>

        <template>
            <h2 class="subtitle text-center mb-0">Edit Profile</h2>

            <div class="popup-fields-container">
                <span class="profile-pic-btn">
                    <input type="file" name="profile-pic" @change="get_profile_pic"/>

                    <img :src="info_edits.avatar" 
                        :alt='"Avatar for" + info_edits.name' 
                        class="profile-pic-thumbnail"/>

                </span>
                <div class="input-field ">
                    <label class="input-label" >Name</label>
                    <input type="text" value="" 
                        :placeholder="info_edits.name" v-model="user_name">

                </div>
                <div class="input-timezone">
                    <div class="input-field " @click="openPicker">
                        <label class="input-label" >Timezone</label>
                        <span class="input-timezone-text">{{timezone.name}}</span>
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

                <div class="time-picker-container">
                        <label class="inline-input-label">Avalability</label>
                        <time-picker @time-pick="start_time = $event">{{start_time}}</time-picker>
                            <hr/>
                        <time-picker@time-pick="end_time = $event">{{end_time}}</time-picker>

                </div>
                
                
            </div>
            <div class="w-100 ">
                <continue-btn @click="updateThisMember" alignment="center" ></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import TimePicker from '../utils/time-picker-comp.vue'
import utils from '../../mixins/utils.vue';
import ContinueBtn from '../utils/buttons/continue-btn';
import { mapState, mapMutations } from 'vuex';

export default {
    name: 'edit-profile-modal',
    components:{
        ModalTemplate,
        TimePicker,
        ContinueBtn
    },
    data(){
        return {
            user_name: null,
            start_time:null,
            end_time:null,
            profile_pic:null,

        }
    },
    mounted(){
        
        this.start_time = this.info_edits.start_hour;
        this.end_time = this.info_edits.end_hour;
        this.timezone.id = this.info_edits.timezone;
        this.timezone.name = this.info_edits.timezone_abbr;

    },
    mixins:[utils],
    computed:{
        ...mapState(['info_edits'])
    },
    methods:{
        ...mapMutations(['setSpecificTeamMember','closeModal']),
        updateTimePick(e){
            console.log(e)
        },
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

           this.timezone.id = id;
           this.timezone.name = name;

           if(el.classList.contains('active')){
                this.$refs.btnArrow.classList.remove('active');
                el.classList.remove('active')
            }
            
        },
        updateThisMember(){
           this.updateProfile().then(status => {
               if( status == 1){
                    this.getMemberInfo(this.info_edits.id).then( (data)=>{
                        
                        this.setSpecificTeamMember({
                            index : this.info_edits.key,
                            team_member : data
                        })

                    })
                    .then(() => this.closeModal('edit-info') );
               }

           }) 
        }
    }
}
</script>
