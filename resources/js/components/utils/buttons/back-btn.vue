<template>
    <button class="btn btn-primary next" :class="alignment_direction" @click="click" :disabled="is_disabled">
        <img src="/img/long-arrow-reverse.svg"/> 
    </button>
</template>

<script>
export default {
    props:{
        alignment:{
            type: String,
            default: 'none'
        },
        disabled:{
            type:[String, Boolean],
            default:'available'
        }
        // click:{
        //     type:Function,
        //     default: () =>{
        //         return false
        //     }
        // }
    },
    computed:{
        is_disabled(){
            if (this.disabled == 'disable'){
                return true;
            }else{
                return false;
            }
        },
        alignment_direction(){

            if(this.alignment == 'center' ){ 
                return 'mx-auto';
            };
            if(this.alignment == 'left' ){ 
                return 'mr-auto';
            };
            if(this.alignment == 'right' ){ 
                return 'ml-auto';
            };

            if(this.alignment == 'none'){
                return ''
            }

        }
    },
    methods:{
        click(){
            this.$emit('click');
        }
    }
}
</script>