<template>
    <div class="modal-container">
        <div class="modal-popup" :class='widthType'>
            <button class="material-icons modal-btn-close"
                @click="close">
                close
            </button>

            <slot></slot>
            
        </div>
        <div class="overlay" @click="close"></div>
    </div>
</template>

<script>
export default {
    name:'modal-template',
    props:['widthType'],
    methods:{
        close(){
            this.$store.commit('closeModal')
        }
    }
}
</script>