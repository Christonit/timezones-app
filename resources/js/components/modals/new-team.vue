<template>

    <modal-template  modal_name="new-team">

        <template>

                
            <div class="type-text-field mb-5">
                <input class="type-text-input" type="text" value="Team Name" 
                    v-model="name" 
                    ref='input'
                    @focus='changeName'
                    @keyup='changeWidth'>
                <h2 class="title placeholder" ref='title'>{{name}}</h2>
               

            </div>

            <div class="w-100 ">
                <continue-btn centered='true' :click="createTeam"></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import {mapMutations, mapState} from 'vuex';

import ModalTemplate from './template.vue';
import ContinueBtn from '../utils/buttons/continue-btn'
export default {
    name: 'new-team-modal',
    components:{
        ModalTemplate,
        ContinueBtn
    },
    data(){
        return {
            name:'Team Name'
        }
    },
    computed:{
        ...mapState(['teams'])
    },
    methods:{
        ...mapMutations(['addTeam']),
        changeName(){
            if(this.name == "Team Name"){
               this.name = ''
            }

            if(this.$refs.title.classList.contains('placeholder')){
                this.$refs.title.classList.remove('placeholder')
            }
        },
       changeWidth(){
                      
            let text_width = this.$refs.title.getBoundingClientRect().width;
            this.$refs.input.style.width = `${text_width}px`;

       },
       createTeam(){

           if(this.name.length > 4 && this.name != 'Team Name'){
               let new_team = {
                   name: this.name,
                   id: (this.teams.length + 1)
               }
               this.addTeam(new_team);
           }
       } 
    }
}
</script>