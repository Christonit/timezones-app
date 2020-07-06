<template>

    <modal-template  modal_name="change-name">

        <template>

                
            <div class="type-text-field mb-5">
                <input class="type-text-input" type="text" value="Team Name" 
                    v-model="name" 
                    ref='input'
                    @focus='changeName'
                    @keyup='changeWidth'>
                <h2 class="title placeholder" ref='title'>{{name}}</h2>
               

            </div>

            <div class="w-100 ">
                <button class="btn btn-primary next material-icons mx-auto">
                    trending_flat 
                </button>
            </div>
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
export default {
    name: 'change-group-name-modal',
    components:{
        ModalTemplate
    },
    data(){
        return {
            name:'Team Name'
        }
    },
    methods:{
        changeName(){
            if(this.name == "Team Name"){
               this.name = ''
            }

            if(this.$refs.title.classList.contains('placeholder')){
                this.$refs.title.classList.remove('placeholder')
            }
        },
       changeWidth(){
           
           
            let text_width = this.$refs.title.getBoundingClientRect().width;
            this.$refs.input.style.width = `${text_width}px`;
           console.log(text_width);

       } 
    }
}
</script>