<template>
    <span  class="checkbox" >
        <input type="checkbox" name="contact-1" value="minie person" @click="onClick">
        <label for="checkbox"></label>
    </span>
</template>

<script>
export default {
    name:'checkbox',
    methods:{
        onClick(e){
            
            this.$emit('click',e.target.checked)
        }
    }
    
}
</script>