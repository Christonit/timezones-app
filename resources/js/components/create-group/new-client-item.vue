<template>
    <div class="input-field-group">

        <input-field name="Full name" 
                :input-value="name" 
                @focus='changeName'
                @input="name = $event"></input-field>

        <input-timezone class="timezone-field" timezone_name="GTM+20"></input-timezone>

        <delete-btn class="large"></delete-btn>
    </div>
</template>

<script>
import InputField from '../utils/forms/input-field.vue';
import InputTimezone from '../utils/input-timezone.vue';
import DeleteBtn from '../utils/buttons/delete-btn.vue';

export default {

    data(){
        return {
            name:'Francis Pujols'
        }
    },
    components:{
        InputTimezone,
        InputField,
        DeleteBtn,
        
    },
}
</script>