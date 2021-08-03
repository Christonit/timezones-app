<script>
export default {
    data(){
        return{
            color_palette:['#21b456','#00a173','#008c82','#007582','#005e72','#2f4858']
        }
    },
    methods:{
        reloadPage(){
            const hostname =window.location.host
            return window.location.replace('/');
        }
    }
} 
</script>