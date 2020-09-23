<template>
    <div class="container-fluid d-flex">

        <aside class="contact-list">

            <div class="contact-list-searchbar">
                <input type="text" class="contact-list-input" placeholder="Search"/>
                <img src="../../img/search-icon.svg" alt="" class="contact-search-icon">
            </div>

            <contact-item v-for="(teammate,key) in team_members" 
            :key="key" :name="teammate.name" 
            :avatar="teammate.avatar" :id="teammate.id"
            :data-teammate-id="'teammate'+teammate.id"
            @addTeammate="addTeammateToCategory($event)"
            @removeTeammate="removeTeammateOfCategory($event)"></contact-item>
            
        </aside>

        <div class="new-group-container">
            <header class="row section-header">
                    <router-link to="/" tag="button" class="btn btn-secondary-link prev">
                        <span>
                            Cancel
                        </span>
                    </router-link>
                    
                    <h2 class="title text-center mb-0" 
                    :class="new_project_group.name == null ? 'btn-dashed-link':'' " 
                    @click="openModal('project_category_name')">
                    {{new_project_group.name == null ? 'Group name' : new_project_group.name}}</h2>

                    <continue-btn></continue-btn>
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
import {mapGetters,mapMutations, mapState} from 'vuex';

import ContinueBtn from './utils/buttons/continue-btn.vue';
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
            hasClients:false,
            team_members_to_group:[]
        }
    },
    components:{
        NewTeamMember,
        ContactItem,
        NewClientItem,
        ContinueBtn,
        InputField,
        InputTimezone,
        NewClientForm
    },
    computed:{
        ...mapState(['new_project_group']),
        ...mapGetters(['team_members']),

    },
    methods:{
        ...mapMutations(['openModal','setNewClient']),
        
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
            document.querySelector(`[data-teammate-id="teammate${id}"] input[type="checkbox"]`).checked = false;
        }


    }
    
}
</script>
