<template>
    <div class="card-grid">
        <user-item view-mode='card' v-for="(number,key) in numbers" :key='key' :user-id="key"></user-item>
    </div>
</template>
<script>

import UserItem from './user-item.vue';

export default {
    data(){
        return {
            numbers:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,16,1,1,1,1,1,1,1,1,1,1,1,1]
        }
    },
    components:{
        UserItem
    }
}
</script>