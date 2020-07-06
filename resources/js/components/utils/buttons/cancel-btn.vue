<template>
    <button  class="btn" 
        :class="alignment_direction + ' ' + (btnType == ' prev destructive' ? 'btn-secondary-link': 'btn-cancel')"
        @click="click">
        <span>
            {{text}}
        </span>
    </button>
</template>

<script>
export default {
    props:{
        alignment:{
            type: String,
            default: 'none'
        },
        btnType:{
            type:String,
            default:'destructive'
        },
        text:{
            type:String,
            default:'Cancel'
        }
    },
    computed:{
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