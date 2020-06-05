<template>

    <modal-template width-type='slim'>

        <template>
            <h2 class="title">Sign or Signup</h2>

            <div class="popup-fields-container">
                <div class="input-field slim">
                    <label class="input-label" for="email">Email</label>
                    <input type="text" value="pujolsfrancis@gmail.com">
                </div>
            </div>
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
    name: 'add-email-modal',
    components:{
        ModalTemplate
    },
    methods:{
        
    }
}
</script>