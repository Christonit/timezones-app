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

                <input-field name="Name" 
                :input-value="user_name" @input="user_name = $event"></input-field>

                <input-timezone :timezone_name="timezone.name"
                @timezone-select="selectTimezones($event)"></input-timezone>

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
import TimePicker from '../utils/time-picker-comp.vue';
import InputTimezone from '../utils/input-timezone.vue';
import InputField from '../utils/forms/input-field.vue';
import utils from '../../mixins/utils.vue';
import ContinueBtn from '../utils/buttons/continue-btn';
import { mapState, mapMutations } from 'vuex';

export default {
    name: 'edit-profile-modal',
    components:{
        ModalTemplate,
        TimePicker,
        ContinueBtn,
        InputTimezone,
        InputField
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

        this.user_name = this.info_edits.name;

    },
    mixins:[utils],
    computed:{
        ...mapState(['info_edits'])
    },
    methods:{
        ...mapMutations(['setSpecificTeamMember','setUserInformation','closeModal']),
        updateTimePick(e){
        },
        selectTimezones(timezone){

           this.timezone.id = timezone.id;
           this.timezone.name = timezone.name;

        },
        updateThisMember(){
           this.updateProfile().then(res => {
                let data = JSON.parse(res) 
                    console.log(data)

        

                if( data.hasOwnProperty('teams_id') ){
                    this.getMemberInfo(this.info_edits.id).then( (data)=>{
                        this.setSpecificTeamMember({
                            index : this.info_edits.key,
                            team_member : data
                        })
                    })
                    .then(() => this.closeModal('edit-info') );

                }else{

                   this.getMemberInfo(this.info_edits.id, true).then( (data)=>{
                        this.setUserInformation(data)
                    })
                    .then(() => this.closeModal('edit-info') );

                }

           }) 
        }
    }
}
</script>
