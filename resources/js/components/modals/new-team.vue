<template>

    <modal-template  modal_name="new-team" width-type="slim">

        <template>
            <h2 class="title text-center mb-0">Create a new team</h2>
            <div class="type-text-field my-5">
                <input-field name="New team name" 
                :input-value="name" 
                @focus='changeName'
                @input="name = $event"></input-field>
            </div>                

            <div class="w-100 ">
                <continue-btn alignment='center' @click="createTeam"></continue-btn>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import {mapMutations, mapState, mapGetters, mapActions} from 'vuex';

import ModalTemplate from './template.vue';
import InputField from '../utils/forms/input-field';
import ContinueBtn from '../utils/buttons/continue-btn'
export default {
    name: 'new-team-modal',
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
        ...mapState(['teams']),
        ...mapGetters(['basic_header'])
    },
    methods:{
        ...mapMutations(['addTeam','setActiveTeam','setTeamMembers']),
        ...mapActions(['getLatestTeam']),

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

               fetch('/create-team',{
               method:'POST',
               headers: this.basic_header,
               body: JSON.stringify({name: this.name})
               }).then(res =>{ 
                   
                    if(res.status == 500){
                        const host = window.location.hostname; 
                        this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
                
                   if(res.status == 200){
                       this.getLatestTeam().then( team => {
                           console.log(team)
                           this.setActiveTeam(team);
                           
                       })
                       .then( () =>{ 
                            let empty_arr = [];
                            this.setTeamMembers(empty_arr);
                            this.$store.commit('closeModal', 'new-team')
                       });
                       
                       
                   }
                });

           }
       } 
    }
}
</script>