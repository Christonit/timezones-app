<template>

    <modal-template  modal_name="delete-group" width-type='slim'>

        <template>
            <h2 class="title text-center mb-5" ref='title'>
                You are about to delete
                <br>
                "{{resource_to_delete.name}}"
            </h2>

            <div class="w-100 d-flex justify-content-center">
                <cancel-btn @click="closeModal('delete-group')"></cancel-btn>
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

import { mapState, mapMutations } from 'vuex';
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
        ...mapState(['resource_to_delete'])
    },
    methods:{
        ...mapMutations(['removeTeamMember','closeModal']),
        deleteThis(){
            this.deleteTeamMember(this.resource_to_delete.id).then( res => {
                if(res.status == 200){
                    console.log("Func: "+this.resource_to_delete.index)
                    return  this.removeTeamMember(this.resource_to_delete.index)
                }else{
                    throw new Error('Something went wrong');
                }

            })
            .then( ()=>{
                this.closeModal('delete-group');
            })
            .catch(error => console.log(error) );

        }
        
    }
}
</script>