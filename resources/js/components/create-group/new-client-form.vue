<template>
     <div class="add-user-input-grid-header input-field-group">

        <input-field name="Full name" 
            :input-value="client.name" 
            @input="client.name = $event"></input-field>

        <input-timezone class="timezone-field" @timezone-select="timezoneSelect($event)" 
        :timezone_name="defaultTZ"></input-timezone>

        <button class="btn btn-add " @click="addNewClient"> 
            <span class="material-icons">
                add
            </span>
        </button>

    </div>
</template>

<script>
import InputField from "../utils/forms/input-field";
import InputTimezone from "../utils/input-timezone";

export default {
    data(){
        return {
            client:{
                name: '',
                timezone:{
                    name:null
                }
            },
            timezone:null,
            potential_clients:[]
        }        
    },
    mounted(){
    },
    components:{
        InputField,
        InputTimezone   
    },
    computed:{
        defaultTZ(){
            if(this.client.timezone == null){
                return null;
            }else{
                return this.client.timezone.name;
            }
        },
    },
    methods:{
        
        timezoneSelect(input){
            console.log(input)
            this.timezone = input;
            this.client.timezone = input;
        },
        addNewClient(){
            const og_clients_len = this.potential_clients.length;

            new Promise( resolve => {

                this.$emit('addClient',{name: this.client.name, timezone: this.timezone});
                this.potential_clients.push({name: this.client.name, timezone: this.timezone});

                let interval = setInterval( ()=>{
                    if(og_clients_len < this.potential_clients.length){
                        clearInterval(interval)
                        resolve();
                    }
                },100)

            })
            .then( ()=> {
                this.timezone = null;

                this.client.timezone = this.timezone

                this.client.name = '';

            })

        }
    }
}
</script>