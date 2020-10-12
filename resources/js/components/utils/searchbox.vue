<template>
    <div class="searchbox">
        <div class="searchbox-keywords" v-if="preliminaryKeywords.length > 0">
            <span class="keyword-chip" v-for="(keyword,index) in preliminaryKeywords">{{keyword.value}}
                <i class="keyword-chip-del" :data-value="keyword.value" @click="removeKeyword">close</i>
            </span>
        </div>

        <div class="searchbox-results">
            <span class="searchbox-result-item" v-for="(result,index) in results" :key="index" :data-keyword-value="result.value">
                <span class="text">{{result.value}}</span>
                <checkbox :key="index" @click="handleToggle($event)" :data-keyword-value="result.value" :data-keyword-key="result.key"></checkbox>
            </span>
           
        </div>

        <div class="searchbox-footnote my-4">
                <continue-btn alignment="center" @click="sendQuery" :disabled="preliminaryKeywords.length > 0 ? 'available': 'disable' "></continue-btn>
        </div>
        
    </div>
</template>

<script>
import Checkbox from '../utils/checkbox-input';
import ContinueBtn from '../utils/buttons/continue-btn';
import { mapGetters } from 'vuex';

export default {
    components:{
        Checkbox,
        ContinueBtn
    },
    data(){
        return{
            preliminaryKeywords:[]
        }
    },
    props:{
        results:{
            type:Array,
            default:[]
        }
    },
    computed:{
        ...mapGetters(['basic_header'])
    },
    methods:{
        sendQuery(){
            let timezone_abbr = [];
            let names = [];
            let groups = [];
            let timezones = [];
            this.preliminaryKeywords.forEach( item => {
                if(item.key == "abbr"){
                  timezone_abbr.push(item.value);  
                }
                if(item.key == "name"){
                  names.push(item.value);  
                }
                if(item.key == "timezone"){
                  timezones.push(item.value);  
                }
                if(item.key == "project"){
                  groups.push(item.value);  
                }
            })

            return fetch('/search-keywords',{
                method:'POST',
                headers:this.basic_header,
                body: JSON.stringify({timezone_abbr,names,groups,timezones})
            })

        },
        handleToggle(data){
            let val = event.target.parentElement.getAttribute('data-keyword-value');
            if(data == true){
                let payload = {};
                payload.value = val;
                payload.key = event.target.parentElement.getAttribute('data-keyword-key')
                this.preliminaryKeywords.push(payload)
            }else{
                this.preliminaryKeywords.find( (el,index)=>{
                   if(el.value == val){
                       this.preliminaryKeywords.splice(index,1)
                   }
                })
            }
        },
        removeKeyword(e){
            let val = e.target.getAttribute('data-value');
            let checkbox = document.querySelector('.searchbox .checkbox[data-keyword-value="'+val+'"] input[type="checkbox"]');
            checkbox.checked = false;
            this.preliminaryKeywords.find( (el,index)=>{
                if(el.value == val){
                    this.preliminaryKeywords.splice(index,1)
                }
            })
        }
    }
}
</script>