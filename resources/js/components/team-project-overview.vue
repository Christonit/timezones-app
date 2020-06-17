<template>

    <div class="app-container">
        
        <top-bar></top-bar>
        <users-timeline-grid></users-timeline-grid>
        <!-- <div class="overlay" v-if="searchbox"></div> -->
        <!-- <div class="container-fluid" v-if=" !timeline_view">
            <div class="row">
                <user-control-bar ></user-control-bar>
                <users-card-grid></users-card-grid>
            </div>
        </div> -->
        
    </div>
    
</template>
<script>
import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';
import UsersTimelineGrid from './users-timeline-grid.vue';

export default {

    data(){
        return {
            timeline_view: false,
            searchbox:true
        }
    },

    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid,
        UsersTimelineGrid
    }
    
}
</script>
