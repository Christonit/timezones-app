<template>

    <modal-template  modal_name="user_created_successfully" width-type='slim'>

        <template>

                
            
                
                <h2 class="title text-center mb-5" ref='title'>
                    You are about to delete
                    <br>
                    "{{title}}"
                </h2>


            <div class="w-100 d-flex justify-content-center">
                <button class="btn btn-cancel">
                    Cancel 
                </button>
                <button class="btn btn-secondary next material-icons">
                    trending_flat 
                </button>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
export default {
    name: 'delete-project-modal',
    components:{
        ModalTemplate
    },
    data(){
        return {
            title:'Parametrics Cabinet'
        }
    },
    methods:{
        
    }
}
</script>