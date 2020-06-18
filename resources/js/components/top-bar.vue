<template>
    <header class="top-bar">
            <div id='top-searchbar' class="input-group">
                <div class="top-searchbar-content">
                    <i class="search-icon"></i>

                    <input  class="form-control top-searchbar-input" 
                        type="text"
                        @click="openSearchbox" 
                        placeholder="Employee name, New York, GTM-1, project 01"/>
                </div>

                <searchbox v-if="team_project.searchbox_visible"></searchbox>
            
            </div>
            <div class="view-toggle">
                <span class="grid-view view-toggle-btn" 
                :class="(team_project.view_mode == 'card') ? 'active' : '' "
                @click="toggleTeamViewMode"></span>

                <span class="list-view view-toggle-btn" 
                :class="(team_project.view_mode == 'timeline') ? 'active': '' " 
                @click="toggleTeamViewMode"></span>

            </div>
            
    </header>
</template>

<script>
import Searchbox from '../components/utils/searchbox.vue';
import {mapState,mapMutations} from 'vuex';
export default {
    data(){
        return {

        }
    },
    computed:{
        ...mapState(['team_project']),
        viewModeToggle(){
            this.team_project.view_mode
        }
    },
    methods:{
        ...mapMutations(['toggleTeamViewMode','toggleSearchbox']),
        openSearchbox(){
            if(this.team_project.searchbox_visible == false){
                return this.toggleSearchbox();
            }
        }
    },
    components:{
        Searchbox
    }
}
</script>