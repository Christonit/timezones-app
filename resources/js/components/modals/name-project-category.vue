<template>

    <modal-template  modal_name="project_category_name" width-type="slim">

        <template>
            <h2 class="title text-center mb-0">What is your group category name?</h2>
            <div class="type-text-field my-5">
                <input-field name="New project name" 
                :input-value="name" 
                @focus='name = $event'
                @input="name = $event"></input-field>
            </div>                

            <div class="w-100 ">
                <continue-btn alignment='center' @click="addGroupName"></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import {mapMutations} from 'vuex';

import ModalTemplate from './template.vue';
import InputField from '../utils/forms/input-field';
import ContinueBtn from '../utils/buttons/continue-btn'
export default {
    name: 'name-project-category-modal',
    components:{
        ModalTemplate,
        ContinueBtn,
        InputField
    },
    data(){
        return {
            name:''
        }
    },
    computed:{
       
    },
    methods:{
        ...mapMutations(['setProjectGroupName','closeModal']),
       
      
       addGroupName(){

           if(this.name.length >= 4 && this.name != 'Team Name'){
               this.setProjectGroupName(this.name); 
               this.closeModal('project_category_name');            

           }
       } 
    }
}
</script>