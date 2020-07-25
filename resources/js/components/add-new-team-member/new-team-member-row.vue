<template>
    <div class="input-field-group  my-3">
        <input-field name="Full name" 
        :input-value="name" @keyup="modifyName" @input="name = $event"></input-field>
        <!-- <div class="input-field">
            <label class="input-label" :class="(name == null || name == '') ? 'placeholder': '' " for="name">Full name</label>
            <input class="input" type="text" @focusin="removePlaceholder" @keyup="modifyName" v-model="name">
        </div> -->
        <input-field name="Email" 
        :input-value="email" @keyup="modifyEmail" @input="email = $event"></input-field>
        
        <input-timezone @timezone-select="modifyNewTeamMemberTimezone({index,timezone:$event})" :timezone_name="member.timezone.name"></input-timezone>

        <delete-btn class="large" @click="deleteNewTeamMember(index)"></delete-btn>
    </div>
</template>

<script>
import InputTimezone from "../utils/input-timezone";
import InputField from "../utils/forms/input-field";
import DeleteBtn from "../utils/buttons/delete-btn";
import validations from "../../mixins/validators.vue";
import { mapMutations } from 'vuex';

export default {
    props:['index','member'],
    data(){
        return {
            name: null,
            email: null,
            timezone:null,
            validation:{
                name: true,
                email: true
            }
        }
    },
    mounted(){
        this.name = this.member.name;
        this.email = this.member.email;
    },
    mixins:[validations],
    components:{
        InputTimezone,
        DeleteBtn,
        InputField
    },
    methods:{
        ...mapMutations([
            'modifyNewTeamMemberTimezone',
            'modifyNewTeamMemberName',
            'modifyNewTeamMemberEmail',
            'deleteNewTeamMember']),
        updateName(name){
            name
        },
        modifyName(){
            
            let validation = this.validateName(this.name);

            if(validation){
                this.modifyNewTeamMemberName({index: this.index, name: this.name})
                this.validation.name = true
            }else{
                this.validation.name = false;
            }

        },
        modifyEmail(){

            let validation = this.validateEmail(this.email);

            if(validation){
                this.modifyNewTeamMemberEmail({index: this.index, email: this.email})
                this.validation.email = true
            }else{
                this.validation.email = false;
            }

        },
        removePlaceholder(e){
            let placeholder = e.target.previousElementSibling;
            if(placeholder.classList.contains('placeholder')){
                placeholder.classList.remove('placeholder')
            }
        }
        
    }
}
</script>