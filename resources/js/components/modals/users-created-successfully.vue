<template>

    <modal-template  modal_name="user_created_successfully" width-type='slim'>

        <template>    
            <h2 class="title text-center mb-5" ref='title'>
                {{new_team_members.length}} were added to project succesfully
            </h2>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="closeThis"></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import ContinueBtn from '../utils/buttons/continue-btn';
import { mapState, mapActions, mapMutations } from 'vuex';

export default {
    name: 'users-created-modal',
    components:{
        ModalTemplate,
        ContinueBtn
    },
    data(){
        return {
            title:'Parametrics Cabinet'
        }
    },
    computed:{
        ...mapState(['new_team_members'])
    },
    methods:{
        ...mapMutations(['closeModal','emptyNewTeamMember']),
        ...mapActions(['getTeamMembers']),
        closeThis(){
            this.closeModal('user_created_successfully');
            this.getTeamMembers();
            this.$router.push('/');
            this.emptyNewTeamMember();
            
        }
        
    }
}
</script>