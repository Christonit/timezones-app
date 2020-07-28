<template>
    <div class="card-grid" v-if="team_members.length > 0">
        <user-item view-mode='card' v-for="(team_member,key) in team_members" :key='key' :index="key" :user="team_member"></user-item>
    </div>
</template>
<script>

import UserItem from './user-item.vue';
import { mapState, mapGetters } from 'vuex';

export default {
    data(){
        return {
        }
    },
    components:{
        UserItem
    },
    computed:{
        ...mapGetters(['team_members']),
        users(){
           return this.team_members; 
        }
    }
}
</script>