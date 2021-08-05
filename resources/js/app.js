/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex, { mapGetters } from 'vuex';
import VueRouter from 'vue-router';
import VueRandomColor from 'vue-randomcolor';

Vue.use(VueRandomColor)
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

import ModalTemplate from './components/modals/template.vue';
import ContinueBtn from './components/utils/buttons/continue-btn.vue';
import CancelBtn from './components/utils/buttons/cancel-btn.vue';
import InputField from './components/utils/forms/input-field.vue';

import ServerErrorPage from './views/500.vue';
import Sidebar from './components/sidebar.vue';
import TeamProjectOverview from './components/team-project-overview.vue';
import AddNewTeamMember from './components/add-new-team-member.vue';
import NewTeamModal from './components/modals/new-team.vue';
import CreateGroup from './components/create-group.vue';
import SignInSignUp from './components/modals/sign-in-sign-up.vue';
import EditTeamProfileModal from './components/modals/edit-team-profile.vue';
import EditProfileModal from './components/modals/edit-profile.vue';
import ChangeGroupNameModal from './components/modals/change-group-name.vue';
import NameProjectCategoryModal from './components/modals/name-project-category.vue';
import UsersCreatedModal from './components/modals/users-created-successfully.vue';
import TeamCreatedModal from './components/modals/team-created.vue'
import AddTeammateModal from './components/modals/add-teammate.vue'
import DeleteProjectModal from './components/modals/delete-project.vue';
import DeleteTeammateModal from './components/modals/delete-teammate.vue';
import {mapState,mapActions, mapMutations} from 'vuex';
import moment from 'moment';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export const bus = new Vue();

const app = new Vue({
    el: '#app',
    store,
    router,
    moment,
    created(){
        this.getUserTeams().then(data =>{
            if(data.length > 0){
                let name = data[0].name;
                let id = data[0].id;
                this.$store.commit("setActiveTeam",{ name, id })
                // router.push(name.toLowerCase().split(" ").join('-'));
                this.getTeamProjects({ name, id })
            }
        });
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
        DeleteTeammateModal,
        NewTeamModal,
        NameProjectCategoryModal,
        ServerErrorPage,
        ModalTemplate,
        ContinueBtn,
        CancelBtn,
        InputField,
    },
    computed:{
        ...mapState(['user','modal_visible','modal','sidebar_visible']),
        ...mapGetters(['header'])
        
    },
    mounted(){
        this.setDeviceWidth();
        window.addEventListener("orientationchange", () => {
            this.setDeviceWidth();
        })

        window.onresize = () => {
            this.setDeviceWidth();
        }

        let csrf= document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this.$store.commit('setCsrf', csrf);

        fetch('/user-information', {
            method:'GET',
            headers: this.header
        }).then(res =>{ 
            if(res.status == 500){
                const host = window.location.hostname; 
                this.$router.push(`/500`);
                throw Error("Server Error");
            }
            return res.text()

        }).then( data => {
            
            let user = JSON.parse(data)
            this.$store.commit('setUserInformation',user);
            this.getTeamMembers();

        })


    },
    methods:{
        ...mapMutations(['toggleSidebar','setDeviceWidth']),
        ...mapActions(['getUserTeams','getTeamMembers','getTeamProjects'])
    }

    
});