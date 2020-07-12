<template>
    <div class="control-bar" v-if="user != null">
        <user-item view-mode='card'  class="active" 
        :logged-user='true'
        :name='user.name'
        :avatar="user.avatar"
        :start_hour="user.start_hour"
        :end_hour="user.end_hour">
        </user-item>
        <div id="user-type-filters">
            <button class="btn btn-link btn-filter active">
                All
                <span class="small-right-arrow-icon"></span>
            </button>
            <button class="btn btn-link btn-filter">
                Teammates
                <span class="small-right-arrow-icon"></span>
            </button>
            <button class="btn btn-link btn-filter">
                Clients
                <span class="small-right-arrow-icon"></span>
            </button>
        </div>

    </div>
</template>

<script>
import UserItem from './user-item.vue';
import {mapState} from 'vuex';
export default {
    data(){
        return {
            avatar: null
        }
    },
    computed:{
        ...mapState(['user']),
        
    },
    components:{
        UserItem
    },
    mounted(){
        this.avatar = window.location.host;
    }
}
</script>