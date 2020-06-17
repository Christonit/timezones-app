<template>
    <aside class="app-sidebar">
        <div class="app-brading">
            <img src="https://via.placeholder.com/140x80" alt="Horatio App" class="logo">
        </div>
    <div class="teams-contain">
        <div class="dropdown team-dropdown">
            <button class="btn btn-secondary dropdown-toggle team-dropdown-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Scopic Software

                
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <button class="dropdown-item active">Action</button>
                <button class="dropdown-item">Another action</button>
                <button class="dropdown-item">Something else here</button>
                <button class="dropdown-item" > 
                    <i class="square-add-icon material-icons ">
                        add
                    </i>        
                New Team</button>
            </div>
            
        </div>
        <button class="btn btn-link white">
            <button class="btn-add-fill material-icons mr-3">
                add
            </button>
            Add teammate
        </button>
    </div>

    <button class="btn btn-link white">
        All team members
    </button>

    <div class="project-list">
        <div class="d-flex pl-3 my-3 align-items-center">
            <b class="sidebar-label">
                Proyects
            </b>

            <button class="btn-add-fill material-icons ml-3">
                add
            </button>

        </div>

        <ul class="item-lists">
            <li class="item">
                Parametrics Cabinet
                <span class="more-option-btn dark">
                    <div class="more-options">
                        <span class="more-options-item">Add teammate</span>
                        <span class="more-options-item">Edit name </span>
                        <span class="more-options-item delete"><img src="../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
                    </div>
                </span>
            </li>
            <li class="item active">
                Parametrics Cabinet
                <span class="more-option-btn dark">
                    <div class="more-options">
                        <span class="more-options-item">Add teammate</span>
                        <span class="more-options-item">Edit name </span>
                        <span class="more-options-item delete"><img src="../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
                    </div>
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
