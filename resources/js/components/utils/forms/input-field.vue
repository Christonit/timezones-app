<template>
    <div class="input-field">
        <label class="input-label" :class="(inputValue == null || inputValue == '') ? 'placeholder': '' " :for="name"> {{name}}</label>
        <input class="input" :type="type" :data-name="name" @focusin="removePlaceholder" @keyup="emitKeyup" v-model="input_val" @input="emitInput">
    </div>
</template>
<script>
export default {
    props:{
        inputValue:{
            type:[String,Number]
        },
        name: {
            type:String
        },
        type: {
            type:String,
            default:'text',
            required:false
        }
    },
    // props:['inputValue','name','type'],
    data(){
        return {
            input_val: ''
        }
    },
    mounted(){
        let int = setInterval( ()=>{
            if(this.inputValue != null || this.inputValue != undefined){
                this.input_val = this.inputValue;
                clearInterval(int);
            }
        },1);
    },
    methods:{
        removePlaceholder(e){
            let placeholder = e.target.previousElementSibling;
            if(placeholder.classList.contains('placeholder')){
                placeholder.classList.remove('placeholder')
            }
        },
        emitKeyup(){
            this.$emit('keyup');
        },
        emitFocus(){
            this.$emit('focus');
        },
        emitBlur(){
            this.$emit('Blur');
        },
        emitInput(){
            this.$emit('input',this.input_val);
        }
    }
    
}
</script>