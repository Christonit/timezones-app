import TeamProjectOverview from '../components/team-project-overview.vue';
import AddNewTeamMember from '../components/add-new-team-member.vue';
import CreateGroup from '../components/create-group.vue';
import FourOhFour from '../views/404.vue';
import ServerErrorPage from '../views/500.vue';

import VueRouter from 'vue-router';


export default new VueRouter({
    routes: [
        {
            path: '/',
            component:TeamProjectOverview
        },
        {
            path: '/team/:projectName',
            component:AddNewTeamMember
        },
        {
            path: '/:projectName/new-project',
            component:CreateGroup,
            props: true
        },
        {
            path: '*',
            redirect: '/404'
        },
        {
            path: '/500',
            component: ServerErrorPage
        },
        {
            path: '/404',
            component: FourOhFour
        }
    ]
})