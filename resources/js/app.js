/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';

Vue.use(Vuex);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import store from './store/index.js'

import Sidebar from './components/sidebar.vue';
import TeamProjectOverview from './components/team-project-overview.vue';
import AddNewTeamMember from './components/add-new-team-member.vue';
import NewTeamModal from './components/modals/new-team.vue';
import CreateGroup from './components/create-group.vue';
import AddEmailModal from './components/modals/add-email.vue';
import EditTeamProfileModal from './components/modals/edit-team-profile.vue';
import EditProfileModal from './components/modals/edit-profile.vue';
import ChangeGroupNameModal from './components/modals/change-group-name.vue';
import UsersCreatedModal from './components/modals/users-created-successfully.vue';
import TeamCreatedModal from './components/modals/team-created.vue'
import AddTeammateModal from './components/modals/add-teammate.vue'
import DeleteProjectModal from './components/modals/delete-project.vue';
import {mapState,mapActions} from 'vuex';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    created(){
        this.getUserTeams();
    },
    components:{
        Sidebar,
        TeamProjectOverview,
        AddNewTeamMember,     
        AddEmailModal,
        CreateGroup,
        ChangeGroupNameModal,
        UsersCreatedModal,
        TeamCreatedModal,
        AddTeammateModal,
        EditTeamProfileModal,
        EditProfileModal,
        DeleteProjectModal,
        NewTeamModal
    },
    computed:{
        ...mapState(['modal_visible','modal'])
    },
    methods:{
        ...mapActions(['getUserTeams'])
    }
    
});
