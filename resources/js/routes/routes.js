import TeamProjectOverview from '../components/team-project-overview.vue';
import AddNewTeamMember from '../components/add-new-team-member.vue';
import CreateGroup from '../components/create-group.vue';

import VueRouter from 'vue-router';


export default new VueRouter({
    routes: [
        {
            path: '/',
            component:TeamProjectOverview
        },
        // {
        //     path: '/:projct-name',
        //     component:TeamProjectOverview
        // },
        {
            path: '/team/:projectName',
            component:AddNewTeamMember
        },
        {
            path: '/:projectName/new-project',
            component:CreateGroup
        }
    ]
})