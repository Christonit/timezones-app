<template>
    <div class="new-member-item">
        <figure class="contact-img">
            <img v-if='avatar != null || avatar == ""'
            :src="avatar" :alt="name + 'profile pic'" >
            <span v-else :style="`background-color:${$randomColor({luminosity:'dark'})}`">{{initialLetters}}</span>

        </figure>
        <span class="contact-name">{{name}}</span>

        <delete-btn alignment="right" @click="deleteMember"></delete-btn>
        
    </div>
                        
</template>

<script>
import DeleteBtn from "../utils/buttons/delete-btn.vue";

export default {
    name:'new-team-member',
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
        }
    },
    components:{
        DeleteBtn
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
        deleteMember(){
            this.$emit('removeTeammate',this.id);

        }
    }
    
}
</script>