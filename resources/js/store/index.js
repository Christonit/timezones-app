import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        modal_visible:false,
        modal:{
            new_team_name:true
        }
    },
    mutations:{
        openModal(state,payload){
            if(payload == 'new_team_name'){
                return state.modal.new_team_name = true;
            }
            state.modal_visible = true;


        },
        closeModal(state,payload){
            if(payload == 'new_team_name'){
               return state.modal.new_team_name = false;
            }
            state.modal_visible = false;


        }
    }
})