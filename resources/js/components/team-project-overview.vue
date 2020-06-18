<template>

    <div class="app-container">
        
        <top-bar></top-bar>
        <div class="overlay" v-if="team_project.searchbox_visible" @click="toggleSearchbox"></div>

        <users-timeline-grid v-if="team_project.view_mode == 'timeline'"></users-timeline-grid>
        <div class="container-fluid" v-else>
            <div class="row">
                <user-control-bar ></user-control-bar>
                <users-card-grid></users-card-grid>
            </div>
        </div>
        
    </div>
    
</template>
<script>
import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';
import UsersTimelineGrid from './users-timeline-grid.vue';
import { mapState, mapMutations } from 'vuex';

export default {

    data(){
        return {
            searchbox:true
        }
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
        ...mapMutations(['toggleSearchbox'])
    }
    
}
</script>
