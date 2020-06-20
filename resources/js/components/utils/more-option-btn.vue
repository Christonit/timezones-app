<template>
    <span class="more-option-btn" :class="mode">
        <div class="more-options">
            <span class="more-options-item" v-if="addBtn"> <span class="btn-add-fill material-icons mr-2">add</span> Add teammate</span>
            <span class="more-options-item" v-if="editBtn"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit info </span>
            <span class="more-options-item" v-if="editName"><img src="../../../img/edit-icon.svg" class="more-options-icon" alt="More options delete icon"> Edit name </span>
            <span class="more-options-item delete" v-if="deleteBtn"><img src="../../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
        </div>
    </span>
</template>

<script>

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
            type:String,
            default:false
        },
        deleteBtn:{
            type:Boolean,
            default:true
        },
        editBtn:{
            type:Boolean,
            default:false
        }
    
    }
}

</script>