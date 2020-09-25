<template>
    <div class="card-grid" v-if="team_members.length > 0">
        <template  v-for="(team_member,key) in team_members">
            <user-item v-if="team_members_filter == 'all' "view-mode='card' :key='key' :index="key" :user="team_member"></user-item>
            <user-item v-if="team_members_filter == 'teammate' && team_member.member_type == 'teammate'"view-mode='card' :key='key' :index="key" :user="team_member"></user-item>
            <user-item v-if="team_members_filter == 'client' && team_member.member_type == 'client'"view-mode='card' :key='key' :index="key" :user="team_member"></user-item>
        </template>
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
        ...mapState(['team_members_filter']),
        ...mapGetters(['team_members']),
        users(){
           return this.team_members; 
        }
    }
}
</script>