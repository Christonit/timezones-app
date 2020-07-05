<script>
export default {
    methods:{
        validateEmail(elementValue){      
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue); 
        }
    }
} 
</script>