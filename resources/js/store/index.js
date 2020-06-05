import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        modal_visible:false
    },
    mutations:{
        closeModal(state){
            state.modal_visible = false;
        }
    }
})