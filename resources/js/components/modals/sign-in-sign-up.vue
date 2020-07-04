<template>

    <modal-template width-type='slim' :has_close="false">

        <h2 class="title">Sign or Signup</h2>

        <template v-if="step == 1">

            <div class="popup-fields-container">
                <div class="input-field slim">
                    <label class="input-label" for="email">Email</label>
                    <input type="text" value="pujolsfrancis@gmail.com">
                </div>
            </div>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="checkEmail"></continue-btn>
            </div>

        </template>
        <template v-if="step == 2">

            <div class="popup-fields-container">
                <div class="input-field slim">
                    <label class="input-label" for="email">Password</label>
                    <input type="password" value="xxxxxx">
                </div>
            </div>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="checkPassword"></continue-btn>
            </div>

        </template>
        <template v-if="step == 3">

            <div class="popup-fields-container">
                <div class="input-field slim">
                    <label class="input-label" for="email">Confirm password</label>
                    <input type="password" value="xxxxxx">
                </div>
            </div>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="validatePassword"></continue-btn>
            </div>

        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import ContinueBtn from './../utils/buttons/continue-btn';

export default {
    // name: 'add-email-modal',
    data(){
        return {
            step: 1
        }
    },
    components:{
        ModalTemplate,
        ContinueBtn
    },
    methods:{
        emit_check(){
            this.$emit('validate_data');
            // console.log('xx')
        },
        checkEmail(){

            this.step = 2
        },
        checkPassword(){
            this.step = 3
        },
        validatePassword(){
            alert('exito')
        } 
    }
}
</script>