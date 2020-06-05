<template>
    <div class="col-12 col-md-9 card-grid">
        <user-item v-for="{number,key} in numbers" :key='key'></user-item>
    </div>
</template>
<script>

import UserItem from './user-item.vue';

export default {
    data(){
        return {
            numbers:[1,2,3,4,5]
        }
    },
    components:{
        UserItem
    }
}
</script>