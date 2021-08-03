<template>
    <span class="more-option-btn" ref="moreOptionsBtn" 
    @click="toggleOptions"
    :class="mode">
        <div 
        class="more-options"    
        @mouseleave="toggleOptions" 
        ref="moreOptions">
           
            <span v-if="editGroup" @click="editProjectGroup" class="more-options-item">
                <img src="../../../img/add-icon.svg" class="more-options-icon" alt="More options delete icon">
                Modify project
            </span>
            <span class="more-options-item" v-if="editBtn" @click="openModal({name:'edit-info',userToEdit})"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit info </span>
            <span class="more-options-item" v-if="editName" @click="changeName"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit name </span>
            <span class="more-options-item delete" v-if="deleteMemberBtn" @click="openModal({name:'delete-teammate', resource})"><img src="../../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete teammate</span>
            <span class="more-options-item delete" v-if="deleteProjectBtn" @click="deleteProject"><img src="../../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
        </div>
    </span>
</template>

<script>
import {mapMutations, mapState} from 'vuex';
export default {
    data(){
        return {
            show_options : false
        }

    },
    props:{
        mode:{
            type:String,
            default: ''
        },
        editGroup:{
            type:Boolean,
            default:false
        },
        addBtn:{
            type:Boolean,
            default:false
        },
        editName:{
            type:Boolean,
            default:false
        },
        deleteMemberBtn:{
            type:Boolean,
            default:false
        },
        deleteProjectBtn:{
            type:Boolean,
            default:false
        },
        editBtn:{
            type:Boolean,
            default:false
        },
        userToEdit:{
            type:Object,
            default:()=>{
                return {};
            },
            required:false
        },
        resource:{
            type:Object,
            default:()=>{
                return {};
            },
            required:false
        }
       
    
    },
    computed:{
        ...mapState(['team_project'])
    },
    methods:{
        ...mapMutations(['openModal']),
        editProjectGroup(e){
            
            this.$router.push(`${this.team_project.name.split(' ').join('-').toLowerCase()}/edit-project?id=${this.resource.id}&name=${this.resource.name}`)
            e.stopPropagation();
            e.preventDefault();
        },
        changeName(e){
            
            this.openModal({name:'change-name', resource: this.resource})
            e.stopPropagation();
            e.preventDefault();
        },
        deleteProject(e){

            this.openModal({name:'delete-project', resource: this.resource})
            e.stopPropagation();
            e.preventDefault();
        },
        toggleOptions(e){
            
            this.$refs.moreOptions.classList.contains('active') ? 
            this.$refs.moreOptions.classList.remove('active') : 
            this.$refs.moreOptions.classList.add('active')

            e.stopPropagation();
            e.preventDefault();
        }
    }
}

</script>