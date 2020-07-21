<template>
    <button class="btn-del" :class="el_alignment" @click="emitClick">
    </button>
</template>

<script>
export default {
    props:{
        alignment:{
            type: [Boolean,String],
            default: false
        }
        
    },
    computed:{
        el_alignment(){

            if(this.alignment == 'center'){ 
                return 'mx-auto';
            };
            if(this.alignment == 'left'){ 
                return 'mr-auto';
            };
            if(this.alignment == 'right'){ 
                return 'ml-auto';
            };

        }
    },
    methods:{
        emitClick(){
            this.$emit("click")
        }
    }
}
</script>