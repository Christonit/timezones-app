<template>
    <div class="input-field-group">

        <input-field name="Full name" 
                :input-value="client.name" 
                @input="name = $event"></input-field>

        <input-timezone class="timezone-field"  @timezone-select="setTimezone($event)" :timezone_name="client.timezone.name"></input-timezone>

        <delete-btn class="large" @click="deteleClient(id)"></delete-btn>
    </div>
</template>

<script>
import InputField from '../utils/forms/input-field.vue';
import InputTimezone from '../utils/input-timezone.vue';
import DeleteBtn from '../utils/buttons/delete-btn.vue';

export default {

    data(){
        return {
            name:'Francis Pujols',
            timezone: 'GMT+2'
        }
    },
    components:{
        InputTimezone,
        InputField,
        DeleteBtn,
        
    },
    props:['client','id'],
    methods:{
        setTimezone(input){
            this.timezone = input;
        },
        deteleClient(id){
            this.$emit('removeClient',id);
        }
    }
}
</script>