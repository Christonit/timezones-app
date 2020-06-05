<template>
    <div class="col-12 col-md-3">
        <user-item class="card active">
        </user-item>
        <div id="user-type-filters">
            <button class="btn btn-link btn-filter">
                All
                <span class="material-icons">
                    arrow_right_alt
                </span>
            </button>
            <button class="btn btn-link btn-filter">
                Teammates
                <span class="material-icons">
                    arrow_right_alt
                </span>
            </button>
            <button class="btn btn-link btn-filter">
                Clients
                <span class="material-icons">
                    arrow_right_alt
                </span>
            </button>
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