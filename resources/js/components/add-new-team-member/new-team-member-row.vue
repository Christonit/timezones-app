<template>
    <div class="input-field-group  my-3">
        <div class="input-field exp-field">
            <label class="input-label black" for="name">Full name</label>
            <input class="input" type="text" @keyup="modifyName" v-model="name">
        </div>
        <div class="input-field">
            <label class="input-label  black" for="email">Email Address</label>
            <input type="text" @keyup="modifyEmail" v-model="email">
        </div>

        <input-timezone @timezone-select="modifyNewTeamMemberTimezone({index,timezone:$event})" :timezone_name="member.timezone.name"></input-timezone>

        <delete-btn class="large" @click="deleteNewTeamMember(index)"></delete-btn>
    </div>
</template>

<script>
import InputTimezone from "../utils/input-timezone";
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
        DeleteBtn
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

        }
        
    }
}
</script>