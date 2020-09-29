<template>
    <div class="container-fluid">
        <header class="row section-header">
            <router-link to='/' tag='button' class="btn btn-secondary-link prev">
                <span>
                    Cancel
                </span>
            </router-link>
                
            <h2 class="title text-center mb-0 ml-auto">Add new members</h2>
            <continue-btn alignment="right" @click.native="saveNewMembers"></continue-btn>   
        </header>
        
        <div class="row justify-content-center">
            <div class="add-new-member-container">
                <div class="add-user-input-grid-header input-field-group">

                    <input-field name="Full name" 
                    :class="member_validation.name == false ? 'invalid':''"
                    :input-value="member.name" @input="member.name = $event"></input-field>
                    
                    <input-field name="Email"
                    :class="member_validation.email == false ? 'invalid':''"
                    :input-value="member.email" @input="member.email = $event"></input-field>

                    <input-timezone @timezone-select="getTimezone" :timezone_name="member.timezone.name"></input-timezone>
                    <button class="btn btn-add large" @click="addNew"> 
                        <span class="material-icons">
                            add
                        </span>
                    </button>
                </div>
                <div class="add-user-input-grid">
                    <template 
                        v-if="new_team_members.length > 0" 
                        v-for="(new_member,key) in new_team_members">
                        <new-team-member-row :key="key" :index="key">
                        </new-team-member-row>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapMutations, mapGetters, mapState} from 'vuex';

import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';
import DeleteBtn from "./utils/buttons/delete-btn.vue";
import ContinueBtn from "./utils/buttons/continue-btn.vue";
import InputTimezone from "./utils/input-timezone.vue";
import InputField from "./utils/forms/input-field";
import NewTeamMemberRow from "./add-new-team-member/new-team-member-row.vue";
import validations from "../mixins/validators.vue";

export default {
    data(){
        return {
            member:{
                name:null,
                email:null,
                timezone:{
                    id: null,
                    name: null
                }
            },
            member_validation:{
                name: null,
                email:null
            }
        }
    },
    mixins:[validations],
    computed:{
        ...mapState(['team_project','new_team_members']),
        ...mapGetters(['basic_header']),
      
        
    },
    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid,
        DeleteBtn,
        ContinueBtn,
        InputTimezone,
        InputField,
        NewTeamMemberRow
    },
    methods:{
        ...mapMutations(['openModal',
        'addNewTeamMember',
        'deleteNewTeamMember',
        'modifyNewTeamMemberName',
        'modifyNewTeamMemberEmail',
        'modifyNewTeamMemberTimezone']),
        prueba(el){
            console.log(el)
        },
        addNew(){

            const timezone = this.member.timezone
            const name = this.member.name
            const email = this.member.email

            let email_validation = this.validateEmail(this.member.email);
            let name_validation = this.validateName(this.member.name);
            name_validation ? this.member_validation.name = true : this.member_validation.name = false;
            email_validation ? this.member_validation.email = true : this.member_validation.email = false;
            
            if(name_validation == true & email_validation == true){
                let obj = {
                name,
                email,
                timezone
                }

                const member = {
                    name:'',
                    email:'',
                    timezone:{
                        id: null,
                        name: null
                    }
                }

                this.member_validation.name  = null;
                this.member_validation.email = null;

                this.addNewTeamMember(obj)

                let int = setInterval( ()=>{
                    
                    document.querySelector('.add-user-input-grid-header .input[data-name="Full name"]').value = ""
                    document.querySelector('.add-user-input-grid-header .input[data-name="Email"]').value = ""
                    clearInterval(int);
                    
                },1);


                return this.member = member;
            }

        },
        clearFields(){
            this.member.name = null;
            this.member.email = null;
            this.member.timezone.id = null;
            this.member.timezone.name = null;
        },
        addNewMembers(){

            this.openModal('user_created_successfully')

        },
        getTimezone(timezone){
               
            this.member.timezone = timezone;

        },
        saveNewMembers(){

            let body = {
                team: this.team_project,
                new_members: this.new_team_members
            }

            fetch('/add-team-members', {
                method:'POST',
                headers:this.basic_header,
                body:JSON.stringify(body)
            })
            .then( res => {
               
                if(res.status == 200){
                    return this.openModal("user_created_successfully");
                }

                if(res.status == 199){
                    throw Error("no-new-member");
                }
                
            })
            .catch(e =>{
                console.log(e)
            })



        }
        
    }
    
}
</script>
