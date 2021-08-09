<template>

    <modal-template  modal_name="delete-team" width-type='slim'>

        <template>
            <h2 class="title text-center" ref='title'>
                You are about to delete team 
                "{{team.name}}" team.
            </h2>

            
            <p class="text text-center">
                This action is irrevocable, it will delete related Projects. 
            </p>

            <p class="text text-center mb--32">
                <b>Are you sure you want to do this?</b>
            </p>

            <div class="w-100 d-flex justify-content-center">
                <cancel-btn @click="closeModal('delete-project')"></cancel-btn>
                <continue-btn class="btn-secondary next" @click="deleteThis"></continue-btn>

            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import utils from '../../mixins/utils.vue';
import ContinueBtn from '../utils/buttons/continue-btn';
import CancelBtn from '../utils/buttons/cancel-btn';

import { mapState, mapMutations, mapActions, mapGetters } from 'vuex';
export default {
    name: 'delete-team-modal',
    components:{
        ModalTemplate,
        ContinueBtn,
        CancelBtn
    },
    mixins:[utils],
    data(){
        return {
            title:'Example Team'
        }
    },
    computed:{
        ...mapState(['resource_to_delete','team_project','team_projects_groups']),
        ...mapGetters(['basic_header','ajax_delete']),
        team(){
            return this.resource_to_delete.resource;
        }
    },
    methods:{
        ...mapMutations(['removeTeamMember','closeModal','removeTeamProject']),
        ...mapActions(['getTeamMembers']),

        deleteThis(){
            let team_id = this.team.id;
            let {_method} = this.ajax_delete;
            console.log(team_id)

                
            fetch(`/teams/${team_id}/delete`, {
                method:'DELETE',
                headers:this.basic_header,
                body:JSON.stringify({_method,team_id})
            })
            .then( res => {
                
                if(res.status == 500){
                    const host = window.location.hostname; 
                    this.$router.push(`/500`);
                    throw Error("Server Error");
                }            
            
                if(res.status == 200){
                    return  location.reload();
                }else{
                    throw new Error('Something went wrong deleting this group.');
                }
            })
            .then( ()=>{
                this.closeModal('delete-team');
            })
            .catch(error => console.log(error) );

        }
        
    }
}
</script>