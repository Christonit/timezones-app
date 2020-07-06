<template>
    <div class="new-member-item">
        <figure class="contact-img">
            <img src="https://via.placeholder.com/32" alt="User X profile pic" >
        </figure>
        <span class="contact-name">Minnie Person</span>

        <delete-btn alignment="right" :click="deleteMember"></delete-btn>

        
        
    </div>
                        
</template>

<script>
import DeleteBtn from "../utils/buttons/delete-btn.vue";

export default {
    name:'new-team-member',
    components:{
        DeleteBtn
    },
    methods:{
        deleteMember(){
            console.log('ddd')
            return '';

        }
    }
    
}
</script>