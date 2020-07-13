import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        user:null,
        screen_sizes:{
            xs:576,
            sm:720,
            md:1024,
            lg:1200
        },
        csrf:'',
        device_width:null,
        sidebar_visible:false,
        modal:{
            new_team:false,
            user_created_successfully: false,
            change_name:false,
            delete_group:false,
            edit_my_profile:false,
            invite_people:false,
            
        },
        team_project:{
            view_mode:'card',
            searchbox_visible:false,
            name: null,
            id:null,
        },
        teams:[],
        projects:[
            {name:'Parametrics',id:'1'},
            {name:'Orca',id:'2'}
        ],
        team_members:[
            {name:'Christopher Santana',
            timezone:'GMT-4',
            available_hours:{
                start:'8:30',
                end:'17:00'},
            projects:['Parametrics', 'Orca']},
            {name:'Alejandro Carmona',
            timezone:'GMT-0',
            available_hours:{
                start:'9:00',
                end:'16:30'},
            projects:['Orca']},
            {name:'Francis Pujols',
            timezone:'GMT-2',
            available_hours:{
                start:'9:00',
                end:'16:30'},
            projects:['Parametrics']}
        ],
        info_edits:null

    },
    getters:{
        basic_header(state){
            return {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':state.csrf
            }
        },
        basic_header_form(state){
            return {
                'X-CSRF-TOKEN':state.csrf
            }
        },
        header(state){
            return {
                'X-CSRF-TOKEN':state.csrf
            }
        }
    },
    mutations:{
        setUserInformation(state,payload){
            state.user = payload;
        },
        setCsrf(state,payload){
            state.csrf = payload;
        },
        setDeviceWidth(state){
            state.device_width = window.innerWidth; 
        },
        toggleTeamViewMode(state){
            if(state.team_project.view_mode == 'card'){
                return state.team_project.view_mode = 'timeline';
            }else{
                return state.team_project.view_mode = 'card';
            }
        },
        toggleSearchbox(state){
            if(state.team_project.searchbox_visible){
                return state.team_project.searchbox_visible = false;
            }

            return state.team_project.searchbox_visible = true;
            
        },
        toggleSidebar(state){

            if(state.sidebar_visible){

                return state.sidebar_visible = false
            }

            return state.sidebar_visible = true;
        },
        openModal(state,payload){

            if(window.innerWidth <= state.screen_sizes.lg){

                state.sidebar_visible = false

            }
            
            if(payload == 'new_team_name'){
                return state.modal.new_team = true;
            }
            if(payload == 'new-team'){
                console.log('hola')
                return state.modal.new_team = true;
            }
            if(payload == 'user_created_successfully'){
                return state.modal.user_created_successfully = true;
            }
            if(payload == 'delete-group'){
                return state.modal.delete_group = true;
            }
            if(payload == 'change-name'){
                return state.modal.change_name = true;
            }
            if(typeof(payload) == "object" & payload.name == 'edit-info'){
                console.log(payload.userToEdit)
                state.info_edits = payload.userToEdit;
                return state.modal.edit_my_profile = true;
            }
            state.modal_visible = true;


        },
        closeModal(state,payload){
            if(payload == 'new_team_name'){
               return state.modal.new_team_name = false;
            }
            if(payload == 'new-team'){
                return state.modal.new_team = false;
            }
            if(payload == 'user_created_successfully'){
               return state.modal.user_created_successfully = false;
            }
            if(payload == 'delete-group'){
               return state.modal.delete_group = false;
            }
            if(payload == 'change-name'){
                return state.modal.change_name = false;
            }
            if(payload == 'edit-info'){
                state.info_edits = null;
                return state.modal.edit_my_profile = false;
            }
            state.modal_visible = false;


        },
        addTeam(state,payload){
            state.teams.push(payload)
        },
        setActiveTeam(state,{name,id}){
            state.team_project.name = name;
            state.team_project.id = id;
        }


    },
    actions:{
        getUserTeams({state,commit},event){

            let dummy_team = {name:'Scopics Software', id:1}

            commit('addTeam',dummy_team)

            //Set dummy frist active project;

            if(state.team_project.name == null){
    
                commit('setActiveTeam', dummy_team);

            }

        }
    }
})