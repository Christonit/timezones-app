<template>

    <div class="app-container">
        
        <top-bar></top-bar>
        <div class="partial-overlay " v-if="team_project.searchbox_visible" @click="toggleSearchbox"></div>

        <users-timeline-grid v-if="team_project.view_mode == 'timeline'"></users-timeline-grid>
        <template v-else>
            <div class="team-title">
                <h1 class="title">{{team_project.name}}</h1>
            </div>
             <div class="card-grid-timeline" >
                <user-control-bar ></user-control-bar>
                <users-card-grid></users-card-grid>
            </div>

        </template>
       
        
    </div>
    
</template>
<script>

import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';
import UsersTimelineGrid from './users-timeline-grid.vue';
import { mapState, mapMutations, mapActions } from 'vuex';

export default {

    data(){
        return {
            searchbox:true
        }
    },
    mounted(){
       
    },
    computed:{
        ...mapState(['team_project'])
    },
    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid,
        UsersTimelineGrid
    },
    methods:{
        ...mapMutations(['toggleSearchbox']),
        ...mapActions(['getTeamMembers'])

    }
    
}
</script>
