import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        screen_sizes:{

        },
        modal:{
            new_team:false,
            user_created_successfully: true,
            
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
        user:{
            name:'Christopher Santanass',
            timezone:'GMT-4',
            available_hours:{
                start:'8:30',
                end:'17:00'
            },
            email:'christopher.alesan@gmail.com',
        },
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
        ]

    },
    mutations:{
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
        openModal(state,payload){
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