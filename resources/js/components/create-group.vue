<template>
    <div class="container-fluid d-flex">

        <aside class="contact-list">

            <div class="contact-list-searchbar">
                <input type="text" class="contact-list-input" placeholder="Search"/>
                <img src="../../img/search-icon.svg" alt="" class="contact-search-icon">
            </div>

            <contact-item v-for="(teammate,key) in team_members" 
            v-if="teammate.member_type == 'teammate' "
            :key="key" :name="teammate.name" 
            :avatar="teammate.avatar" :id="teammate.id"
            :data-teammate-id="teammate.id"
            @addTeammate="addTeammateToCategory($event)"
            @removeTeammate="removeTeammateOfCategory($event)"></contact-item>
            
        </aside>

        <div class="new-group-container">
            <header class="row section-header">
                    <cancel-btn class="btn-secondary-link prev" @click="closeNewGroup">
                    </cancel-btn>
                    <!-- <router-link to="/" tag="button" class="btn btn-secondary-link prev">
                        <span>
                            Cancel
                        </span>
                    </router-link> -->
                    <h2 class="title text-center mb-0" v-if="isProjectToEdit == true">{{$route.query.name}}</h2>
                    <h2 class="title text-center mb-0" 
                    v-if="isProjectToEdit == false"
                    :class="new_project_group.name == null ? 'btn-dashed-link':'' " 
                    @click="openModal('project_category_name')">
                    {{new_project_group.name == null ? 'Group name' : new_project_group.name}}</h2>

                    <continue-btn @click="submitFunction"></continue-btn>
            </header>
            <div class="row">
                <div class="content ">
                    <h3 class="subtitle">Team members
                        <button class="clear-btn">Clear All</button>
                    </h3>

                    <div class="new-members-grid" v-if="team_members_to_group.length > 0">
                        <new-team-member v-for="(teammate,key) in team_members_to_group" :key="key" 
                        :name="teammate.name" :avatar="teammate.avatar" 
                        :id="teammate.id"
                        @removeTeammate="removeTeammateOfCategoryFromList($event)"></new-team-member>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="content ">
                    <div class="add-clients-form">
                        <h3 class="subtitle">Clients <button class="clear-btn">Clear All</button></h3>
                        <button class="btn-dashed" @click="hasClients = true" v-if="hasClients == false">
                           Add client 
                        </button>

                        <new-client-form @addClient="clients.push($event)" v-if="hasClients"></new-client-form>

                        <div class="add-user-input-grid" v-if="clients.length > 0">
                            <new-client-item v-for="(client, index) in clients" 
                            :id="index" 
                            :key="index" 
                            :client="client" 
                            @removeClient="clients.splice($event,1)"
                            class="mb--12"></new-client-item>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import {mapActions, mapGetters,mapMutations, mapState} from 'vuex';

import ContinueBtn from './utils/buttons/continue-btn.vue';
import CancelBtn from './utils/buttons/cancel-btn.vue';
import NewClientForm from './create-group/new-client-form.vue';
import NewTeamMember from './create-group/new-team-member-item.vue';
import ContactItem from './create-group/contact-item.vue';
import NewClientItem from './create-group/new-client-item.vue';
import InputField from './utils/forms/input-field.vue';
import InputTimezone from './utils/input-timezone.vue';


export default {
    data(){
        return {
            
            clients:[],
            og_clients:[],
            hasClients:false,
            team_members_to_group:[],
            og_teammates:[]
        }
    },
    mounted(){


        if(this.$route.query.id != null) {
            let project_name = this.$route.params.projectName;
            let id = this.$route.query.id;
            let team_id = this.team_project.id;

            this.getTeamMembers()

            fetch(`${project_name}/project?id=${id}`)
            .then( (res)=> {
                return res.text();
            })
            .then( data =>{ 
                let members = JSON.parse(data);

                members.forEach(member => {
                    if(member.member_type == "teammate"){
                        this.team_members_to_group.push(member)
                        this.og_teammates.push(member)
                    }
                    else{ 
                        let id = member.id
                        let member_type = member.member_type
                        let name = member.name
                        let timezone = member.timezone

                        this.og_clients.push({id,name,member_type,timezone})
                        this.clients.push({id,name,member_type,timezone})
                    }
                })

                return members
            })
            .then( (data)=>{

                data.forEach( item => {

                    let interval = setInterval( ()=> {
                        let el = document.querySelector(`[data-teammate-id="${item.id}"]`);
                        if( el ){
                            document.querySelector(`[data-teammate-id="${item.id}"] input[type="checkbox"] `).checked = true;
                            clearInterval(interval)
                        }  
                    },50)
                    
                })

                if(this.clients.length > 0 && this.hasClients == false){
                    this.hasClients = true
                }

            })
        }
    },
    components:{
        NewTeamMember,
        ContactItem,
        NewClientItem,
        ContinueBtn,
        CancelBtn,
        InputField,
        InputTimezone,
        NewClientForm
    },
    computed:{
        ...mapState(['new_project_group','team_project']),
        ...mapGetters(['team_members','basic_header']),
        isProjectToEdit(){
            if(this.$route.query.name != undefined && this.$route.query.id != undefined && this.$route.query.name.length > 0){
                return true
            }

            return false
            
        }

    },
    methods:{
        ...mapMutations(['openModal','setNewClient','addTeamProjects','emptyProjectGroup','getTeamMembers']),
        ...mapActions(['getTeamMembers']),
        closeNewGroup(){
            this.emptyProjectGroup();
            this.$router.go(-1)
        },
        clearClientForm(){
            this.client.name = '';
            this.client.timezone.name = '';
            this.client.timezone.id = '';
        },
        addTeammateToCategory(id){
            let teammate = this.team_members.find( (item, key) => {
                return item.id == id
            })

            this.team_members_to_group.push(teammate);

        },
        removeTeammateOfCategory(id){
            this.team_members_to_group.forEach( (teammate, key) => {
                if(teammate.id == id){
                    return this.team_members_to_group.splice(key,1)
                }
            })

        },
        removeTeammateOfCategoryFromList(id){
            this.removeTeammateOfCategory(id);
            document.querySelector(`[data-teammate-id="${id}"] input[type="checkbox"]`).checked = false;
        },
        submitFunction(){

            if(this.isProjectToEdit){
                return this.updateGroup();
            }else{
                return this.createGroup();
            }

        },
        updateGroup(){

            let body = {};

            let project_id = this.$route.query.id;
            let teammates_ids = this.team_members_to_group.map( teammate => {
                return teammate.id;
            })
            let og_teammates_ids = this.og_teammates.map( teammate => {
                return teammate.id;
            })

            body.teammates = teammates_ids;
            body.og_teammates = og_teammates_ids;
            body._method = "PUT";

            if(this.hasClients == true && this.clients.length > 0){
                body.clients = this.clients;
            }
            body.og_clients = this.og_clients;

            return fetch(`/update-project-category-members/${project_id}`,
                {method:'PUT',
                headers:this.basic_header,
                body:JSON.stringify(body)
                }).then( res => {
                    if(res.status == 201 || res.status == 200){
                        return res.text();
                    }
                }).then( data => {
                    let project_nav = document.querySelector('.project-list .item.active');
                    this.emptyProjectGroup();
                    this.$router.go(-1)
                    project_nav != null && project_nav != undefined ? project_nav.classList.remove('active') : null;

                })
               

        },
        createGroup(){
            let teammates_ids = this.team_members_to_group.map( teammate => {
                return teammate.id;
            })
            let body = {
                teammates: teammates_ids,
                name:this.new_project_group.name};

            if(this.hasClients == true && this.clients.length > 0){
                body.clients = this.clients;
            }

            // console.log(body);

            // return teammates_ids;
            return fetch(`/create-project-category/team/${this.team_project.id}`,
                {method:'POST',
                headers:this.basic_header,
                body:JSON.stringify(body)
                }).then( res => {
                    if(res.status == 201 || res.status == 200){
                        return res.text();
                    }
                }).then( data => {
                    let project = JSON.parse(data);
                    this.emptyProjectGroup();
                    this.addTeamProjects(project);
                    this.$router.go(-1)

                })
        }


    }
    
}
</script>
