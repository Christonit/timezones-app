<script>
import { mapGetters } from 'vuex';
 
export default {
    computed:{
            ...mapGetters(['basic_header'])
    },
    methods:{
        fetch_timezones_list(){
            let timezones_data = null;
            let x = fetch(`https://dev.virtualearth.net/REST/v1/TimeZone/List/?timezonestandard=IANA&key=AmdZGBzRdAtTx2w_t1j0Vsc4M5Apj5P83OKc-17qDE2ytTEoqLLgJS0_jPL-UrLw`).then(res => res.text() ).then( data =>{
                timezones_data = JSON.parse(data) 
            })

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
        }
    }
}
</script>
