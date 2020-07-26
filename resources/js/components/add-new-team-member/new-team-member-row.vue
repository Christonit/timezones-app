<template>
    <div class="input-field-group  my-3">
        <input-field name="Full name"  :key="index + 'A'"
        :input-value="name" @keyup="modifyName" @input="name = $event"></input-field>
        
        <input-field name="Email" :key="index + 'B'"
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
            name: this.member.name,
            email: this.member.email,
            timezone:null,
            validation:{
                name: true,
                email: true
            }
        }
    },
    created(){

        this.name = null
        this.email = null
        
    },
    mounted(){

        this.name = this.member.name;
        this.email = this.member.email;
    },
    beforeUpdate(){
        setTimeout( ()=>{
        this.name = this.member.name;
        this.email = this.member.email;
        },100)

    },
    updated(){

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