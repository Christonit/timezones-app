<script>
export default {
    name:'ProjectGroups',
    methods:{
        getTeamProjects(name,id){
            let url_name = name.toLowerCase().split(" ").join("-");

            return fetch(`${url_name}/team?id=${id}`)
                    .then(res =>{ 
                        if(res.status == 500){
                            const host = window.location.hostname; 
this.$router.push(`/500`);
                            throw Error("Server Error");
                        }
                        return res.text()})
                    .then( data => console.log(data));
        }
    }
}
</script>