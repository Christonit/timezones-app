<template>
    <div class="control-bar" v-if="user != null">

        <user-item view-mode='card'  class="active"
        :user="user" 
        :logged-user="true">
        </user-item>

        <div id="user-type-filters" v-if="is_teammember_type_mixed">
            <button class="btn btn-link btn-filter"  :class="team_members_filter == 'all' ? 'active': ''" @click="setTeamMembersFilter('all')">
                All
                <span class="small-right-arrow-icon"></span>
            </button>
            <button class="btn btn-link btn-filter"  :class="team_members_filter == 'teammate' ? 'active': ''" @click="setTeamMembersFilter('teammate')">
                Teammates
                <span class="small-right-arrow-icon"></span>
            </button>
            <button class="btn btn-link btn-filter" :class="team_members_filter == 'client' ? 'active': ''" @click="setTeamMembersFilter('client')">
                Clients
                <span class="small-right-arrow-icon"></span>
            </button>
        </div>

    </div>
</template>

<script>
import UserItem from './user-item.vue';
import {mapGetters, mapMutations, mapState} from 'vuex';
import moment from 'moment-timezone';

export default {
    data(){
        return {
            avatar: null,
        }
    },
    computed:{
        ...mapState(['user','team_members_filter']),
        ...mapGetters(['is_teammember_type_mixed'])
    },
    components:{
        UserItem
    },
    created() {
    },
    mounted(){

    },
    methods:{
        ...mapMutations(['setTeamMembersFilter'])
        
    }
}
</script>