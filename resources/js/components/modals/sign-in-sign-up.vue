<template>

    <modal-template width-type='slim' :has_close="false">


        <template v-if="step == 'email'">

            <h2 class="title">Sign in or Signup</h2>

            <div class="popup-fields-container">
                <input-field key="email" class="slim" name="Email" :input-value="email" @input="email = $event"></input-field>
            </div>
            <div class="w-100" v-if="error == 'bad email'">
                <p>Please, insert a valid email</p>
            </div>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="checkEmail"></continue-btn>
            </div>

        </template>

        <template v-if="step == 'new user'">

            <h2 class="title">New user</h2>

            <div class="popup-fields-container">
                <input-field key="name" 
                class="slim" name="Name" :input-value="name" 
                @input="name = $event" ></input-field>
            
            </div>
            <div class="footnote-buttons">
                <cancel-btn btn-type='back' text="Previews" @click="previewsStep('email')"></cancel-btn>
                <continue-btn alignment="center" @click="checkName" ></continue-btn>
            </div>

        </template>

        <template v-if="step == 'type password'">

            <h2 class="title" v-if="user_type == 'new user'">New user</h2>
            <h2 class="title" v-else>Sign in or Signup</h2>

            <div class="popup-fields-container">

                <input-field key="password" class="slim" type="password" name="Password" :input-value="password" @input="password = $event"></input-field>

                <a :href="'/password/reset'" v-if="!(user_type == 'new user')">Forgot password?</a>
            </div>

            <div class="w-100" v-if="error == 'invalid password'">
                <p>Password has to be at least 6 characters length.</p>
            </div>
            <div class="w-100" v-if="error == 'invalid information'">
                <p>Invalid credentials. Please review your email & password.</p>
            </div>

            <div class="footnote-buttons">

                <cancel-btn btn-type='back' text="Previews" 
                    @click="(user_type == 'new user' ? previewsStep('new user') : previewsStep('email'))"></cancel-btn>
                
                <continue-btn alignment="center" 
                    @click="(user_type == 'existing user')? logUser() : checkPassword()"
                    :disabled="password.length < 6 ? true : false "></continue-btn>

            </div>

        </template>

        <template v-if="step == 'confirm password'">

            <h2 class="title">New user</h2>

            <div class="popup-fields-container">

                <input-field key="password_confirm"class="slim" type="password" name="Confirm password" :input-value="password_confirm" @input="password_confirm = $event"></input-field>

            </div>

            <div class="w-100" v-if="error == 'password dont match'">
                <p>Passwords doesnt match.</p>
            </div>

            <div class="footnote-buttons">
                <cancel-btn btn-type='back' text="Previews" 
                @click="previewsStep('type password')"></cancel-btn>
                <continue-btn alignment="center" @click="createUser" :disabled="password_confirm.length < 6 ? true : false "></continue-btn>
            </div>

        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
import ContinueBtn from './../utils/buttons/continue-btn';
import CancelBtn from './../utils/buttons/cancel-btn';
import InputField from '../utils/forms/input-field';
import { mapState, mapGetters } from 'vuex';
import validators from '../../mixins/validators';

export default {
    // name: 'add-email-modal',
    data(){
        return {
            step: 'email',
            email:null,
            name:null,
            password:'',
            password_confirm:'',
            error:null,
            user_type: null
        }
    },
    mixins:[validators],
    computed:{
        ...mapState(['csrf']),
        ...mapGetters(['basic_header']),
        url(){
            return window.location.host;   
        }
    },
    components:{
        ModalTemplate,
        ContinueBtn,
        InputField,
        CancelBtn
    },
    methods:{
        previewsStep(step){
            return this.step = step;
        },
        checkEmail(){
            if( this.validateEmail(this.email) ){
                this.error = null
                fetch('/check-email', {
                    method:'POST',
                    headers:this.basic_header,
                    body: JSON.stringify({'email':this.email})
                }).then( res => {
                    if(res.status == 200){
                        return res.text()
                    }

                    if(res.status == 500){
                        const host = window.location.hostname; 
this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
            
            
                }).then( data => {
                    this.user_type = data;
                    if(data == 'new user'){
                        this.step = 'new user'
                    }else{
                        this.step = 'type password'
                    }
                })

            }else{
                return this.error ="bad email"
            }
            
        },

        checkPassword(){
            if(this.password.length >= 6){

                if(this.user_type == 'new user'){

                    return this.step = 'confirm password';

                }else{
                    this.logUser();
                }
            }else{
                return this.error = 'invalid password';
            }

        },
        checkName(){
            if(this.name.length > 4){
                this.step = 'type password'
            }else{
                return this.error = 'invalid name';
            }
        },
        createUser(){
            let form = {
                name:this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirm
            };

            if(this.password_confirm == this.password){
                
                return fetch('/register', {
                    method: 'POST',
                    headers: this.basic_header,
                    body: JSON.stringify(form)
                })
                .then( res => {
                    let status = res.status;
                    let url = window.location.host;
                    if(status == 200){
                        window.location.replace('/')
                    }
                    
                    if(status == 500){
                        const host = window.location.hostname; 
this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
            
            
                })

            }else{
                return this.error = 'password dont match';
            }
        },
        logUser(){

            let form = {
                email: this.email,
                password: this.password
            };

            return fetch('/login', {
                    method: 'POST',
                    headers: this.basic_header,
                    body: JSON.stringify(form)
                })
                .then( res => {
                    if(res.status == 500){
                        const host = window.location.hostname; 
this.$router.push(`/500`);
                        throw Error("Server Error");
                    }
                    return res.text()
                
                })
                .then(data=>{
                    if(data == 200){
                        return window.location.replace('/')
                    }else{
                        this.password = '';
                        this.error = data;
                    }
                })

        } 
    }
}
</script>