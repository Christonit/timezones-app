<script>
export default {
    methods:{
        validateEmail(elementValue){   
            let el = (elementValue == null) ? '' : elementValue;
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(el); 
        },
        validateName(name){
            let el = (name == null) ? '' : name;
            return el.length > 3 ? true : false;
        }
    }
} 
</script>