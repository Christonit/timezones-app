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
    props:
    {
        widthType:{
          default:'',
          type:String
        },
        modal_name:{
            default:'',
            type:String
        }
    },
    methods:{
        close(){
            if(this.modal_name == ''){
                return;
            }

            this.$store.commit('closeModal', this.modal_name)
        }
    }
}
</script>