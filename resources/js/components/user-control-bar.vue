<template>
    <div class="col-12 col-md-3">
        <div class="control-bar">
            <user-item class="card active">
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
export default {
    data(){
        return {

        }
    },
    components:{
        UserItem
    }
}
</script>