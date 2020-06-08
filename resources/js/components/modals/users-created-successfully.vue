<template>

    <modal-template  modal_name="user_created_successfully" width-type='slim'>

        <template>

                
            
                
                <h2 class="title text-center mb-5" ref='title'>
                    44 User were created succesfully
                </h2>


            <div class="w-100 ">
                <button class="btn btn-primary next material-icons mx-auto">
                    trending_flat 
                </button>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
export default {
    name: 'users-created-modal',
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