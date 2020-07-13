/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex, { mapGetters } from 'vuex';
import VueRouter from 'vue-router';

Vue.use(Vuex);
Vue.use(VueRouter)
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
import router from './routes/routes.js'

import Sidebar from './components/sidebar.vue';
import TeamProjectOverview from './components/team-project-overview.vue';
import AddNewTeamMember from './components/add-new-team-member.vue';
import NewTeamModal from './components/modals/new-team.vue';
import CreateGroup from './components/create-group.vue';
import SignInSignUp from './components/modals/sign-in-sign-up.vue';
import EditTeamProfileModal from './components/modals/edit-team-profile.vue';
import EditProfileModal from './components/modals/edit-profile.vue';
import ChangeGroupNameModal from './components/modals/change-group-name.vue';
import UsersCreatedModal from './components/modals/users-created-successfully.vue';
import TeamCreatedModal from './components/modals/team-created.vue'
import AddTeammateModal from './components/modals/add-teammate.vue'
import DeleteProjectModal from './components/modals/delete-project.vue';
import {mapState,mapActions, mapMutations} from 'vuex';
import moment from 'moment';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router,
    moment,
    created(){
        this.getUserTeams();
    },
    components:{
        Sidebar,
        TeamProjectOverview,
        AddNewTeamMember,     
        SignInSignUp,
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
        ...mapState(['modal_visible','modal','sidebar_visible']),
        ...mapGetters(['header'])
        
    },
    mounted(){
        this.setDeviceWidth();
        window.addEventListener("orientationchange", () => {
            this.setDeviceWidth();
        })

        let csrf= document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this.$store.commit('setCsrf', csrf);

        fetch('/user-information', {
            method:'GET',
            headers: this.header
        }).then(res => res.text()).then( data => {
            
            let user = JSON.parse(data)
            this.$store.commit('setUserInformation',user);

        })


    },
    methods:{
        ...mapMutations(['toggleSidebar','setDeviceWidth']),
        ...mapActions(['getUserTeams'])
    }

    
});
