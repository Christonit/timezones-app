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
            <div class="col-12 col-lg-8 ">
                <div class="add-user-input-grid-header input-field-group">
                    <input class="input-field" type="text" placeholder="Full Name"v-model="member.name">
                    <input class="input-field" type="text" placeholder="Email Address"v-model="member.email">
                    <input-timezone @timezone-select="getTimezone" :timezone_name="member.tz.name"></input-timezone>
                    <button class="btn btn-add " @click="addNew"> 
                        <span class="material-icons">
                            add
                        </span>
                    </button>
                </div>
                <div class="add-user-input-grid">
                    <template 
                        v-if="new_team_members.length > 0" 
                        v-for="(new_member,key) in new_team_members">
                        <new-team-member-row :member="new_member" :index="key">
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
import NewTeamMemberRow from "./add-new-team-member/new-team-member-row.vue";

export default {
    data(){
        return {
            member:{
                name:null,
                email:null,
                tz:{
                    id: null,
                    name: null
                }
            }
        }
    },
    computed:{
        ...mapState(['team_project','new_team_members']),
        ...mapGetters(['basic_header'])
    },
    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid,
        DeleteBtn,
        ContinueBtn,
        InputTimezone,
        NewTeamMemberRow
    },
    methods:{
        ...mapMutations(['openModal',
        'addNewTeamMember',
        'deleteNewTeamMember',
        'modifyNewTeamMemberName',
        'modifyNewTeamMemberEmail',
        'modifyNewTeamMemberTimezone']),
        addNew(){
            const timezone = this.member.tz
            const name = this.member.name
            const email = this.member.email

            let obj = {
                name,
                email,
                timezone
            }

            const member = {
                name:null,
                email:null,
                tz:{
                    id: null,
                    name: null
                }
            }

            this.addNewTeamMember(obj)
            this.member = member;

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
               
            this.member.tz = timezone;

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
