<template>
    <div class="col-12 col-md-3">
        <div class="control-bar">
            <user-item view-mode='card'  class="active"
            :name='username'>
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
        username(){
            if(this.user.name.length > 20){
                return `${this.user.name.substring(0,18)}...`;
            }
            return this.user.name;
        }
    },
    components:{
        UserItem
    }
}
</script>