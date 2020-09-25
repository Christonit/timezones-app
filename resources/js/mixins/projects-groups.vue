<script>
export default {
    name:'ProjectGroups',
    methods:{
        getTeamProjects(name,id){
            let url_name = name.toLowerCase().split(" ").join("-");

            return fetch(`${url_name}/team?id=${id}`)
                    .then(res => res.text())
                    .then( data => console.log(data));
        }
    }
}
</script>