<template>

    <modal-template  modal_name="delete-project" width-type='slim'>

        <template>
            <h2 class="title text-center mb-5" ref='title'>
                You are about to delete the
                "{{project.name}}" project group.
            </h2>

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
        ...mapState(['resource_to_delete','team_project','team_projects_groups']),
        ...mapGetters(['basic_header','ajax_delete']),
        project(){
            return this.resource_to_delete.resource;
        }
    },
    methods:{
        ...mapMutations(['removeTeamMember','closeModal','removeTeamProject']),
        ...mapActions(['getTeamMembers']),

        deleteThis(){
            let project_id = this.project.id;
            let team_id = this.project.teams_id;
            let {_method} = this.ajax_delete;
            console.log(project_id)

                
            fetch(`delete-project-category/${project_id}`, {
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
                    let active_project = document.querySelector('.project-list .item-lists .item.active');

                    this.team_projects_groups.find( (item, key) => {
                        if(active_project != null || active_project != undefined){
                            if(active_project.getAttribute('data-project-name') == item.name){
                                this.getTeamMembers();
                                active_project.classList.remove('active');
                            }
                        } 

                        if(item.id == project_id){
                            this.removeTeamProject(key);
                        }
                    })
                }else{
                    throw new Error('Something went wrong deleting this group.');
                }
            })
            .then( ()=>{
                this.closeModal('delete-project');
            })
            .catch(error => console.log(error) );

        }
        
    }
}
</script>