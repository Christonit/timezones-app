<template>
    <div class="contact-item">
        <figure class="contact-img">
             <img v-if='avatar != null || avatar == ""'
            :src="avatar" :alt="name + 'profile pic'" >
            <span v-else :style="`background-color:${$randomColor({luminosity:'dark'})}`">{{initialLetters}}</span>

        </figure>
        <span class="contact-name">{{name}}</span>

        <checkbox @click="addOrRemoveTeammate($event)"></checkbox>
        
    </div>
</template>

<script>
import Checkbox from '../utils/checkbox-input.vue'
export default {
    props:{
        avatar:{
            type:String,
            default:null,
            required:false
        },
        name:{
            type:String,
            default:null,
            required:false
        },
        id:{
            type:Number,
            default:0,
            required:false
        },
        // key:{
        //     type:Number
        // }
    },
    mounted(){
    },
    components:{
        Checkbox
    },
    computed:{
        initialLetters(){
            let name = this.name.split(" ");

            if(name.length < 2){
                return this.name.slice(0,2);
            }

            let abbr = [];
            
            name.forEach( letter => {

                let el = letter.slice(0,1);
                
                abbr.push(el);
            })

            return abbr.join('');
 
        }
    },
    methods:{
        addOrRemoveTeammate(check){
            if(check == true){
                this.$emit('addTeammate',this.id);
            }else{
                this.$emit('removeTeammate',this.id);
            }
        }
    }
}
</script>