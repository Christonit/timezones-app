<template>
    <div class="container-fluid">
        <top-bar></top-bar>

        <div class="row">
            <user-control-bar id="control-bar"></user-control-bar>
            <users-card-grid>
            </users-card-grid>
        </div>
    </div>
</template>
<script>
import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';

export default {

    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid
    }
    
}
</script>
