<template>
    <div class="input-field-group  my-3">
        <input-field name="Full name"  :key="index + 'A'"
        :input-value="name" @keypress="prueba($event)"  @input="modifyName($event)"></input-field>
        
        <input-field name="Email" :key="index + 'B'"
        :input-value="email" @keypress="prueba($event)" @input="modifyEmail($event)"></input-field>
        
        <input-timezone @timezone-select="modifyNewTeamMemberTimezone({index,timezone:$event})" :timezone_name="new_user.timezone.name"></input-timezone>

        <delete-btn class="large" @click="deleteNewTeamMember(index)"></delete-btn>
    </div>
</template>

<script>
import InputTimezone from "../utils/input-timezone";
import InputField from "../utils/forms/input-field";
import DeleteBtn from "../utils/buttons/delete-btn";
import validations from "../../mixins/validators.vue";
import { mapMutations, mapState } from 'vuex';

export default {
    props:['index'],
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
    created(){

        this.name = null
        this.email = null
        
    },
    mounted(){
        if (window.getSelection){
            console.log( window.getSelection() );
        }
        this.name = this.new_user.name;
        this.email = this.new_user.email;
    },
    beforeUpdate(){
        setTimeout( ()=>{
            this.name = this.new_user.name;
            this.email = this.new_user.email;
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
    computed:{
        ...mapState(['new_team_members']),
          new_user(){
            return this.new_team_members[this.index];

        }
    },
    methods:{
        ...mapMutations([
            'modifyNewTeamMemberTimezone',
            'modifyNewTeamMemberName',
            'modifyNewTeamMemberEmail',
            'deleteNewTeamMember']),

        prueba(el){
            console.log(el)
        },
        
        modifyName(input){
            
            // let validation = this.validateName(input);

            // if(validation){
                this.name = input;
                this.modifyNewTeamMemberName({index: this.index, name: input})
                // this.validation.name = true
            // }else{
                // this.validation.name = false;
            // }

        },
        modifyEmail(input){

            // let validation = this.validateEmail(input);

            // if(validation){
                this.email = input;
                this.modifyNewTeamMemberEmail({index: this.index, email: input})
                // this.validation.email = true
            // }else{
                // this.validation.email = false;
            // }

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