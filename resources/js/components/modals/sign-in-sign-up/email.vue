<template>
    <div>

            <h2 class="title text-center">Sign in or Signup</h2>

            <div class="popup-fields-container">
                <input-field class="slim" name="Email" :input-value="email" @input="email = $event"></input-field>
            </div>
            <div class="w-100" v-if="error == 'bad email'">
                <p>Please, insert a valid email</p>
            </div>
            <div class="w-100 ">
                <continue-btn alignment="center" @click="checkEmail"></continue-btn>
            </div>

    </div>
</template>

<script>
export default {
    name:"name-step",
    data(){
        return {
            email:''
        }
    }
}
</script>