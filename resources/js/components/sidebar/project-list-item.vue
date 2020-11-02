<template>
    <li class="item"
    :data-project-name="current_project.name"
    @click="selectProject"
    >
        {{current_project.name}}
        
        <more-option-btn mode="dark" :edit-group="true" :edit-name="true" 
        :delete-project-btn="true" :add-btn="true" 
        :resource="resource_wrapper(current_project,index)"></more-option-btn>
</li> 

</template>

<script>
import { mapMutations, mapState } from 'vuex';
import MoreOptionBtn from "../utils/more-option-btn";

export default {
    props:{
        index:{
            type:[Number, String],
            default: null
        },
        project:{
            type: Object,
            default: () => {}
        }
    },
    components:{
        MoreOptionBtn
    },
    computed:{
        ...mapState(['team_projects_groups']),
        current_project(){
            return this.team_projects_groups[this.index];
        }

    },
    methods:{
        ...mapMutations(['getTeamProject','setTeamMembers']),
        resource_wrapper(resource,index){
            let data = resource;
            data.resource_type = "project-category";
            data.key = index;

            return data;
        },
        selectProject(e){
            let project_name = e.target.getAttribute('data-project-name').toLowerCase().split(' ').join('-');
            let project_id = e.target.getAttribute('data-project-id');
            let el = e.target.parentElement.querySelector('.item.active');

            (el != null) ? el.classList.remove('active') : '';

            fetch( `/${this.current_project.name}/project?id=${project_id}`)
            .then(res => res.text())
            .then(data => this.setTeamMembers(JSON.parse(data) ))
            e.target.classList.add('active')
            
            e.preventDefault();
            e.stopPropagation();
        }
    }        
}
</script>