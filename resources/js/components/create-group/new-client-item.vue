<template>
    <div class="input-field-group">
        <div class="input-field">
            <label class="input-label  black" for="name">Full name</label>
            <input type="text" value="pujolsfrancis@gmail.com">
        </div>
        <div class="input-field timezone-field">
            <label class="input-label  black" for="email">Timezones</label>
            <input type="text" value="GTM + 1">
        </div>
        <delete-btn class="large"></delete-btn>
    </div>
</template>

<script>
import DeleteBtn from '../utils/buttons/delete-btn.vue';

export default {
    components:{

        DeleteBtn,
        
    },
}
</script>