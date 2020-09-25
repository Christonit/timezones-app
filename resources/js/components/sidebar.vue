<template>
    <aside class="app-sidebar" :class="mobile_sidebar_visible">
        <div class="app-brading">
            <img src="../../img/logo-placeholder.png" alt="Orca" class="logo">
        </div>

        <div class="teams-contain">
            <div class="dropdown team-dropdown">

                <button 
                class="btn btn-secondary dropdown-toggle team-dropdown-btn" role="button" 
                id="teams-list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                v-if="team_project.id != null">
                    {{team_project.name}}
                </button>

                <button class="dropdown-item" @click="openModal('new-team')" v-else> 
                    <i class="square-add-icon material-icons ">
                        add
                    </i>        
                    New Team
                </button>

                <div class="dropdown-menu" aria-labelledby="teams-list">

                    <template v-if="teams.length > 0" 
                        v-for="(team,key) in teams">
                        <button class="dropdown-item" ref="selectTeam" @click="selectTeam(team.name, team.id)">
                            {{team.name}}

                            <more-option-btn mode="dark" :edit-name="true" :delete-project-btn="true" 
                            :resource="{id:team.id, name:team.name, resource_type:'team', index:key}"></more-option-btn>
                        </button>
                    </template>

                    <button class="dropdown-item" @click="openModal('new-team')"> 
                        <i class="square-add-icon material-icons ">
                            add
                        </i>        
                        New Team
                    </button>
                </div>
                
            </div>

            <router-link v-if="team_project.id != null" :to="`/team/${team_project.name.split(' ').join('-').toLowerCase()}`" tag='button' class="btn btn-link btn-add-teammte ">
                <button class="btn-add-fill material-icons mr-3">
                    add
                </button>
                Add teammate
            </router-link>
        
        </div>

    <button class="btn btn-link white justify-content-start">
        All team members
    </button>

    <div class="project-list" v-if="team_project.id != null">
        <div class="d-flex pl-3 my-3 align-items-center">
            <b class="sidebar-label">
                Proyects
            </b>

            <router-link :to="`/${team_project.name.split(' ').join('-').toLowerCase()}/new-project`" tag='button' class="btn-add-fill material-icons ml-3">
                add
            </router-link>
             
        </div>

        <ul class="item-lists" v-if="team_projects_groups.length > 0">
            <li class="item" v-for="(project,key) in team_projects_groups">
                {{project.name}}
                <more-option-btn mode="dark" :edit-name="true" :delete-project-btn="true" :add-btn="true"></more-option-btn>
            </li>
            <!-- <li class="item active">
                Parametrics Cabinet
                <more-option-btn mode="dark" :edit-name="true" :delete-project-btn="true" :add-btn="true"></more-option-btn>
            </li> -->
        </ul>
        
    </div>
        <a href="/logout" class="btn-logout">Logout user</a>
    </aside>
</template>

<script>
import {mapMutations,mapActions, mapState} from 'vuex';

import MoreOptionBtn from "./utils/more-option-btn.vue";

export default {
    mounted() {
    },
    computed:{
        ...mapState(['teams','team_project','sidebar_visible','team_projects_groups']),
        mobile_sidebar_visible(){
            return this.sidebar_visible == true ? 'active' : '';
        }
    },
    methods:{
        ...mapMutations(['openModal','setActiveTeam']),
        ...mapActions(['getTeamMembers','getTeamProjects']),

        selectTeam(name,id){
            if(document.querySelector('.team-dropdown .dropdown-item.active')){
                document.querySelector('.team-dropdown .dropdown-item.active').classList.remove('active');
            }            
            event.target.classList.add('active')
            this.setActiveTeam({name,id});
            this.getTeamMembers().then(()=>{
             this.getTeamProjects({ name, id })
            });

        }
    },
    components:{
        MoreOptionBtn
    }

}
</script>
