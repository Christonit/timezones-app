<template>
    <span class="more-option-btn" :class="mode">
        <div class="more-options">
            <router-link v-if="addBtn" :to="`/team/${team_project.name.split(' ').join('-').toLowerCase()}`" tag='span' class="more-options-item">
                <img src="../../../img/add-icon.svg" class="more-options-icon" alt="More options delete icon">
                Add teammate
            </router-link>
            <span class="more-options-item" v-if="editBtn" @click="openModal('edit-info')"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit info </span>
            <span class="more-options-item" v-if="editName" @click="openModal('change-name')"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit name </span>
            <span class="more-options-item delete" v-if="deleteMemberBtn" @click="openModal('delete-group')"><img src="../../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete teammate</span>
            <span class="more-options-item delete" v-if="deleteProjectBtn" @click="openModal('delete-group')"><img src="../../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
        </div>
    </span>
</template>

<script>
import {mapMutations, mapState} from 'vuex';
export default {
    props:{
        mode:{
            type:String,
            default: ''
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
        }
    
    },
    computed:{
        ...mapState(['team_project'])
    },
    methods:{
        ...mapMutations(['openModal'])
    }
}

</script>