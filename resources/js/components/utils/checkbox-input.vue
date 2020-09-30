<template>
    <span  class="checkbox" >
        <input type="checkbox" ref="customCheck" name="contact-1" value="minie person" @click="onClick">
        <label for="checkbox"></label>
    </span>
</template>

<script>
export default {
    name:'checkbox',
    beforeUpdate(){
        this.$refs.customCheck.checked = false
    },
    activated(){
        this.$refs.customCheck.checked = false
    },
    methods:{
        onClick(e){
            
            this.$emit('click',e.target.checked)
        }
    }
    
}
</script>