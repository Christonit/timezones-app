<template>
    <aside class="app-sidebar">
        <div class="app-brading">
            <img src="https://via.placeholder.com/140x80" alt="Horatio App" class="logo">
        </div>
    <div class="teams-contain">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <button class="dropdown-item" href="#">Action</button>
                <button class="dropdown-item" href="#">Another action</button>
                <button class="dropdown-item" href="#">Something else here</button>
            </div>
            
        </div>
        <button class="btn btn-link">
            <span class="material-icons mr-2">
                add_circle
            </span>
            Add teammate
        </button>
    </div>

    <button class="btn btn-link">
        All team members
    </button>

    <div class="project-list">
        <div class="d-flex">
            <b class="label">
                Proyects
            </b>

            <button class="material-icons ml-2">
                add_circle
            </button>

        </div>

        <ul class="item-lists">
            <li class="item">
                Parametrics Cabinet
                <span class="material-icons">
                    more_vert
                </span>
            </li>
        </ul>
        
    </div>
        
    </aside>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
