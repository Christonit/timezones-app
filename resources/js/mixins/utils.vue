<script>
import { mapGetters } from 'vuex';
 
export default {
    data(){
        return {
            timezone_input:'',
            user: "Christopher Santana",
            timezone:{id:"America/Detroit",name:"EST - Eastern Standard Time"},
            start_time:null,
            end_time:null,
            timezones_list:[],
            profile_pic:null,
            default_gmt : [
                {name:'GMT', id: 'America/Danmarkshavn'},
                {name:'GMT-2', id: 'America/South_Georgia'},
                {name:'GMT-3', id: 'America/Montevideo'},
                {name:'GMT-4', id: 'America/New_York'},
                {name:'GMT-5', id: 'America/Panama'},
                {name:'GMT-6', id: 'America/Mexico_City'},
                {name:'GMT-7', id: 'America/Denver'},
                {name:'GMT-8', id: 'America/Los_Angeles'},
                {name:'GMT-9', id: 'America/Anchorage'},
                {name:'GMT+1', id: 'Europe/Madrid'},
                {name:'GMT+2', id: 'Europe/Bucharest'},
                {name:'GMT+3', id: 'Europe/Moscow'},
                {name:'GMT+4', id: 'Asia/Dubai'},
                {name:'GMT+5', id: 'Asia/Tashkent'},
                {name:'GMT+6', id: 'America/Anchorage'},
                {name:'GMT+7', id: 'Asia/Jakarta'},
                {name:'GMT+8', id: 'Asia/Singapore'},
                {name:'GMT+9', id: 'Asia/Tokyo'},
                {name:'GMT+10', id: 'Australia/Sydney'},
                {name:'GMT+11', id: 'Pacific/Norfolk'},
                {name:'GMT+12', id: 'Pacific/Fiji'}
                ]
        }
    },
    computed:{
            ...mapGetters(['basic_header','header']),
            timezones(){

                if(this.timezones_list.length == 0){
                    return this.default_gmt;
                }

                return this.timezones_list;
            }
    },
    methods:{
        get_profile_pic(e){
            this.profile_pic = e.target.files[0];
        },
        searchTimezones(){
            if(this.timezone_input.length > 0){
                let input = {search:this.timezone_input.toUpperCase()};
                fetch('/search-timezones',
                {method:'POST',
                headers:this.basic_header,
                body:JSON.stringify(input)})
                .then( res => res.text())
                .then( data => this.timezones_list = JSON.parse(data) )
            }
        },
        fetch_timezones_list(){
            let timezones_data = null;
            let x = fetch(`https://dev.virtualearth.net/REST/v1/TimeZone/List/?timezonestandard=IANA&key=AmdZGBzRdAtTx2w_t1j0Vsc4M5Apj5P83OKc-17qDE2ytTEoqLLgJS0_jPL-UrLw`).then(res => res.text() ).then( data =>{
                timezones_data = JSON.parse(data) 
            }).then( () =>{
                let timezones = timezones_data.resourceSets[0].resources;

            let arr = [];

            timezones.forEach( timezone => {
                let name =  timezone.timeZone.genericName;
                let iana_time_zone_id = timezone.timeZone.ianaTimeZoneId
                let utc_offset = timezone.timeZone.utcOffset
                let abbreviation = null

            if(timezone.timeZone.hasOwnProperty('abbreviation') ){
                abbreviation = timezone.timeZone.abbreviation
            } 

                arr.push({name,abbreviation,iana_time_zone_id,utc_offset})

            })

            let upload_timezone = (timezone) => {
                fetch('/upload-timezones',
                    {method:'POST',
                    headers:this.basic_header,
                    body:JSON.stringify(timezone)
                    }).then( res => res.status)
            }

            arr.forEach(timezone => upload_timezone(timezone) )
            });     
        },

        updateProfile(){
            
            let payload = new FormData();

            payload.append('timezone',this.timezone.id)
            payload.append('timezone_abbr', this.timezone.name)
            payload.append('name', this.user)
            payload.append('start_hour',this.start_time)
            payload.append('end_hour',this.end_time)
            
            if(this.profile_pic != null){
                payload.append('avatar',this.profile_pic);
            }

            fetch('/update-user',{
                method: 'POST',
                headers:this.header,
                body:payload
            }).then( res => res.text())
            .then(res => {
                if(res.status == 201){
                    this.$store.commit('closeModal', 'edit-info');
                    
                }
            })
        }
    }
}
</script>
