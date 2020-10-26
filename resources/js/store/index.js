import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    strict:true,
    state:{
        user:null,
        hour_clock:12,
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
            project_category_name:false
        },
        team_project:{
            view_mode:'card',
            searchbox_visible:false,
            name: null,
            id:null,
        },
        teams:[],
        projects:[
            // {name:'Parametrics',id:'1'},
            // {name:'Orca',id:'2'}
        ],
        new_project_group:{
            name:null,
            clients:[],
            teammates:[]
        },
        team_members:[],
        // team member filters can be all, mates or clients only. To filter in the UI only. 
        team_members_filter:"all",
        new_team_members:[],
        info_edits:null,
        resource_to_delete:null,
        potential_clients:[],
        team_projects_groups:[],
        active_query_keywords:[]

    },
    getters:{
        team_members(state){
            return state.team_members;
        },
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
        },
        ajax_delete(state){
            return {
                _method: "DELETE"
            }
        },
        is_teammember_type_mixed(state){
            let onlyTeammate = state.team_members.every( item => item.member_type == 'teammate');
            let onlyClient = state.team_members.every( item => item.member_type == 'client');

            if(onlyTeammate == false && onlyClient == false){
                return true;
            }else{
                return false;
            }
        }

    },
    mutations:{
        setUserInformation(state,payload){
            state.user = payload;
        },
        switchHourClock(state){
            console.log('xxxxx');
            return (state.hour_clock == 12) ? state.hour_clock = 24 : state.hour_clock = 12;
        },
        setTeamMembers(state,payload){
            state.team_members = payload;
        },
        setSpecificTeamMember(state,{index,team_member}){
           
            state.team_members.splice(index,1,team_member);
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
                return state.modal.new_team = true;
            }
            if(payload == 'user_created_successfully'){
                return state.modal.user_created_successfully = true;
            }
            if(payload == 'project_category_name'){
                return state.modal.project_category_name = true;
            }
            if(payload.name == 'delete-group'){
                state.resource_to_delete = payload.resource;
                return state.modal.delete_group = true;
            }
            if(payload.name == 'change-name' ){
                state.info_edits = payload.resource;
                return state.modal.change_name = true;
            }
            if(typeof(payload) == "object" & payload.name == 'edit-info'){
                state.info_edits = payload.userToEdit;
                return state.modal.edit_my_profile = true;
            }
            state.modal_visible = true;
    
            event.stopPropagation();
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
            if(payload == 'project_category_name'){
               return state.modal.project_category_name = false;
            }
            if(payload == 'delete-group'){
               state.resource_to_delete = null;
               return state.modal.delete_group = false;
            }
            if(payload == 'change-name'){
                state.info_edits = null;
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
        editTeam(state,{index,name}){
            state.teams[index].name = name;
        },
        removeTeam(state,payload){
            state.teams.splice(payload,1);
        },
        addNewTeamMember(state, payload){
            state.new_team_members.unshift(payload);
        },
        deleteNewTeamMember(state, payload){
            state.new_team_members.splice(payload,1);
        },
        emptyNewTeamMember(state){
            state.new_team_members = [];
        },
        modifyNewTeamMemberName(state, {index,name}){
            state.new_team_members[index].name = name;
        },
        modifyNewTeamMemberEmail(state, {index,email}){
            state.new_team_members[index].email = email;
        },
        modifyNewTeamMemberTimezone(state, {index,timezone}){
            state.new_team_members[index].timezone = timezone;
        },
        setActiveTeam(state,{name,id}){
            state.team_project.name = name;
            state.team_project.id = id;
        },
        removeTeamMember(state, payload){
            state.team_members.splice(payload,1);
        },
        setNewClient(state,payload){
            //Create a group related state.
            state.potential_clients.push(payload);
        },
        setProjectGroupName(state,payload){
            state.new_project_group.name = payload;
        },
        setTeamProjects(state,payload){
            state.team_projects_groups = payload
        },
        setTeamMembersFilter(state,payload){
            state.team_members_filter = payload;
        },
        setActiveProject(state,payload){

        },
        setQueryKeywords(state,payload){
            state.active_query_keywords.push(payload);
        },
        removeQueryKeywords(state,payload){
            state.active_query_keywords.splice(payload,1);
            console.log("2");

        }
        


    },
    actions:{
        getUserTeams({state,commit},event){


            return fetch('/list-teams').then( res => {
                if(res.status == 200){
                    return res.text();
                }
            }).then( data => {
                let teams = JSON.parse(data);
                teams.forEach( team => commit('addTeam',team))
                
                return teams;
            })
        },
        getLatestTeam({state,commit}){
            return fetch('/list-latest-created-team').then(res=> res.text()).then(data => {
                let info = JSON.parse(data)
                commit('addTeam',info);

                return info;
            })
        },
        getTeamMembers({state,commit}){
            return fetch(`/list-team-members/${state.team_project.id}`)
                    .then(res => res.text())
                    .then(data => {
                        commit('setTeamMembers',JSON.parse(data))
                    })
        },
        getTeamProjects({commit},{name,id}){
            let url_name = name.toLowerCase().split(" ").join("-");

            return fetch(`${url_name}/team?id=${id}`)
                    .then(res => res.text())
                    .then( data => {
                        let payload = JSON.parse(data);
                        commit('setTeamProjects',payload);
                    });
        },
        updateQueryKeywords({state,getters,commit,dispatch},payload){
            console.log("1");
            // return false;
            commit('removeQueryKeywords',payload);
            console.log("3");
            let timezone_abbr = [];
            let names = [];
            let groups = [];
            let timezones = [];
            let team_id = state.team_project.id;

            state.active_query_keywords.forEach( item => {
                if(item.key == "abbr"){
                  timezone_abbr.push(item.value);  
                }
                if(item.key == "name"){
                  names.push(item.value);  
                }
                if(item.key == "timezone"){
                  timezones.push(item.value);  
                }
                if(item.key == "project"){
                  groups.push(item.value);  
                }
            })

            if(state.active_query_keywords.length == 0){
                return dispatch("getTeamMembers",team_id)
            }else{

                return fetch('/search-keywords',{
                    method:'POST',
                    headers: getters.basic_header,
                    body: JSON.stringify({timezone_abbr,names,groups,timezones,team_id})
                }).then(res => {
                    if(res.status == 200){
                     return res.text();   
                    } 
                })
                .then( data => {
                    let mates = JSON.parse(data)

                    commit("setTeamMembers",mates);
                })

            }
        }

    }
})