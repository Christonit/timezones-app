<template>
    <aside class="app-sidebar">
        <div class="app-brading">
            <img src="https://via.placeholder.com/140x80" alt="Orca" class="logo">
        </div>

    <div class="teams-contain">
        <div class="dropdown team-dropdown">
            <button class="btn btn-secondary dropdown-toggle team-dropdown-btn" role="button" id="teams-list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{team_project.name}}
            </button>

            <div class="dropdown-menu" aria-labelledby="teams-list">

                <template v-for="(team,key) in teams">

                    <button class="dropdown-item" 
                        ref="selectTeam"
                        @click="selectTeam(team.name, team.id)">
                            {{team.name}}
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
        <button class="btn btn-link white">
            <button class="btn-add-fill material-icons mr-3">
                add
            </button>
            Add teammate
        </button>
    </div>

    <button class="btn btn-link white">
        All team members
    </button>

    <div class="project-list">
        <div class="d-flex pl-3 my-3 align-items-center">
            <b class="sidebar-label">
                Proyects
            </b>

            <button class="btn-add-fill material-icons ml-3" >
                add
            </button>

        </div>

        <ul class="item-lists">
            <li class="item">
                Parametrics Cabinet
                <span class="more-option-btn dark">
                    <div class="more-options">
                        <span class="more-options-item">Add teammate</span>
                        <span class="more-options-item">Edit name </span>
                        <span class="more-options-item delete"><img src="../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
                    </div>
                </span>
            </li>
            <li class="item active">
                Parametrics Cabinet
                <span class="more-option-btn dark">
                    <div class="more-options">
                        <span class="more-options-item">Add teammate</span>
                        <span class="more-options-item">Edit name </span>
                        <span class="more-options-item delete"><img src="../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
                    </div>
                </span>
            </li>
        </ul>
        
    </div>
        
    </aside>
</template>

<script>
import {mapMutations,mapActions, mapState} from 'vuex';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        computed:{
            ...mapState(['teams','team_project'])
        },
        methods:{
            ...mapMutations(['openModal','setActiveTeam']),
            selectTeam(name,key){

                document.querySelector('.team-dropdown .dropdown-item').classList.remove('active');
                event.target.classList.add('active')
                this.setActiveTeam({name,key});

            }
        }

    }
</script>
