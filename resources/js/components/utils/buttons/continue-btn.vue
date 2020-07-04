<template>
    <button class="btn btn-primary next" :class="alignment_direction" @click="click">
        <img src="/img/long-arrow.svg"/> 
    </button>
</template>

<script>
export default {
    props:{
        alignment:{
            type: String,
            default: 'none'
        },
        // click:{
        //     type:Function,
        //     default: () =>{
        //         return false
        //     }
        // }
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
            console.log('1')
            this.$emit('click');
        }
    }
}
</script>