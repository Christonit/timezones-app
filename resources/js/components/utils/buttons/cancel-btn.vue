<template>
    <button class="btn btn-primary next" :class="alignment" @click="click">
        <img src="/img/long-arrow.svg"/> 
    </button>
</template>

<script>
export default {
    props:{
        centered:{
            type: [Boolean,String],
            default: false
        },
        click:{
            type:Function,
            default:false
        }
    },
    computed:{
        alignment(){

            if(this.centered ){ 
                return 'mx-auto';
            };

        }
    }
}
</script>