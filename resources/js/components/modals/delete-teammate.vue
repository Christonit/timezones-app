<template>

    <modal-template  modal_name="delete-teammate" width-type='slim'>

        <template>
            <h2 class="title text-center mb-5" ref='title'>
                You are about to delete
                <br>
                "{{resource_to_delete.name}}"
            </h2>

            <div class="w-100 d-flex justify-content-center">
                <cancel-btn @click="closeModal('delete-teammate')"></cancel-btn>
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

import { mapState, mapMutations, mapGetters } from 'vuex';
export default {
    name: 'delete-project-modal',
    components:{
        ModalTemplate,
        ContinueBtn,
        CancelBtn
    },
    mixins:[utils],
    data(){
        return {
            title:'Parametrics Cabinet'
        }
    },
    computed:{
        ...mapState(['resource_to_delete','team_project']),
        ...mapGetters(['basic_header','ajax_delete'])
    },
    mounted(){
        console.log('xxxx true')
    },
    methods:{
        ...mapMutations(['removeTeamMember','closeModal']),
        deleteThis(){

            if(this.resource_to_delete.teammate){
                this.deleteTeamMember(this.resource_to_delete.id).then( res => {
                    if(res.status == 200){
                        return  this.removeTeamMember(this.resource_to_delete.index)
                    }else{
                        throw new Error('Something went wrong');
                    }

                })
                .then( ()=>{
                    this.closeModal('delete-teammate');
                })
                .catch(error => console.log(error) );

            }


            if(this.resource_to_delete.resource_type =="team" ){

                fetch(`delete-team/${this.resource_to_delete.id}`, {
                    method:'DELETE',
                    headers:this.basic_header,
                    body:JSON.stringify(this.ajax_delete)
                })
                .then( res => {
                    if(res.status == 200){
                        return  this.removeTeam(this.resource_to_delete.index)
                    }else{
                        throw new Error('Something went wrong');
                    }

                })
                .then( ()=>{
                    this.closeModal('delete-teammate');
                })
                .catch(error => console.log(error) );

            }
            
        }
        
    }
}
</script>