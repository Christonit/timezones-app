<template>
    <div class="control-bar">
        <user-item view-mode='card'  class="active" :logged-user='true'
        :name='user.name'>
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

        }
    },
    computed:{
        ...mapState(['user']),
        
    },
    components:{
        UserItem
    }
}
</script>