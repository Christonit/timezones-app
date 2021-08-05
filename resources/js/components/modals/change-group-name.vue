<template>

    <modal-template  modal_name="change-name" width-type='slim'>

        <template v-if="info_edits.resource_type == 'team'">
            <h2 class="title text-center mb-0">Edit team name</h2>
            <div class="type-text-field my-5">
                <input-field name="Edit name" 
                :input-value="name" 
                @input="name = $event"></input-field>
               
            </div>

            <div class="w-100 ">
                <continue-btn alignment="center"
                @click="changeName"
                :disabled="is_disabled"></continue-btn>
                <!-- <button class="btn btn-primary next material-icons mx-auto">
                    trending_flat 
                </button> -->
            </div>
        </template>
        <template v-if="info_edits.resource_type == 'project-category'">
            <h2 class="title text-center mb-0">Edit project name</h2>
            <div class="type-text-field my-5">
                <input-field name="Edit name" 
                :input-value="name" 
                @input="name = $event"></input-field>
               
            </div>

            <div class="w-100 ">
                <continue-btn alignment="center"
                @click="changeProjectName"
                :disabled="is_disabled"></continue-btn>
                <!-- <button class="btn btn-primary next material-icons mx-auto">
                    trending_flat 
                </button> -->
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import {bus} from "../../app.js";

import ModalTemplate from './template.vue';
import InputField from '../utils/forms/input-field.vue';
import ContinueBtn from '../utils/buttons/continue-btn';
import { mapState, mapGetters, mapMutations } from 'vuex';

export default {
    name: 'change-group-name-modal',
    components:{
        ModalTemplate,
        InputField,
        ContinueBtn
    },
    data(){
        return {
            name:''
        }
    },
    mounted(){
        this.name = this.info_edits.name
    },
    computed:{
        ...mapState(['team_project','info_edits']),
        ...mapGetters(['basic_header']),


        is_disabled(){
            if(this.name != this.info_edits.name & this.name.length > 3){
                return false
            }

            return true;
        }
    },
    methods:{
        ...mapMutations(['setActiveTeam','editTeam','closeModal','editTeamProjects']),
        changeName(){
            if(this.name != this.info_edits.name & this.name.length > 3){
                this.info_edits.resource_type == "team" ? this.changeTeamName() : ''
            }
        },
        changeProjectName(){
            if(this.name != this.info_edits.name & this.name.length > 3){
                this.info_edits.resource_type == "project-category" ? this.changeProjectName() : ''
            }
        },
        changeTeamName(){
            fetch('/edit-team-name',{
                    method:'POST',
                    headers:this.basic_header,
                    body:JSON.stringify({
                        id:this.info_edits.id,
                        name: this.name
                    })
                })
                .then( res => {
                    if(res.status == 200){

                        if(this.team_project.name == this.info_edits.name){
                            this.setActiveTeam({name: this.name, id: this.info_edits.id})
                        }

                        this.editTeam({index: this.info_edits.index,name:this.name})

                    }

                    
                    if(res.status == 500){
                        const host = window.location.hostname; 
                        this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
            
            
                })
                .then( () => {
                    this.closeModal('change-name')
                })
        },
        changeProjectName(){
            fetch(`/update-project-category/${this.info_edits.id}`,{
                    method:'PUT',
                    headers:this.basic_header,
                    body:JSON.stringify({
                        name: this.name
                    })
                })
                .then( res => {
                    if(res.status == 200){
                        return res.text();
                    }

                    if(res.status == 500){
                        const host = window.location.hostname; 
                        this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
                })
                .then( (data) => {
                    let key = this.info_edits.key;
                    let content = JSON.parse(data);
                    this.editTeamProjects({key,content})
                    bus.$emit('changedProjectName')
                    this.closeModal('change-name')
                })
                
        }
    }
}
</script>