<template>
    <div class="container-fluid d-flex">
        <aside class="contact-list">
            <div class="contact-list-searchbar">
                <input type="text" class="contact-list-input" placeholder="Search"/>
                <img src="https://via.placeholder.com/24" alt="" class="contact-search-icon">
            </div>
            <div class="contact-item">
                <figure class="contact-img">
                    <img src="https://via.placeholder.com/32" alt="User X profile pic" >
                </figure>
                <span class="contact-name">Minnie Person</span>

                <span  class="checkbox" >
                    <input type="checkbox" name="contact-1" value="minie person">
                    <label for="checkbox"></label>

                </span>
            </div>
            <div class="contact-item">
                <figure class="contact-img">
                    <img src="https://via.placeholder.com/32" alt="User X profile pic" >
                </figure>
                <span class="contact-name">Minnie Person</span>

                <span  class="checkbox" >
                    <input type="checkbox" name="contact-1" value="minie person">
                    <label for="checkbox"></label>

                </span>
            </div>
        </aside>
        <div class="new-group-container w-100">
            <header class="row section-header">
                    <button class="btn btn-secondary-link prev">
                        <span class="material-icons">
                            keyboard_backspace
                        </span> 
                        <span>
                            Cancel
                        </span>
                    </button>
                    <h2 class="title text-center mb-0">Add new members</h2>
                    <button class="btn btn-primary next material-icons">
                        trending_flat 
                    </button>
            </header>
            <div class="row">
                <div class="content ">
                    <h3 class="subtitle">Team members
                        <button class="clear-btn">Clear All</button>
                    </h3>

                    <div class="new-members-grid">
                        <new-team-member></new-team-member>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="content ">
                    <div class="add-clients-form">
                        <h3 class="subtitle">Clients <button class="clear-btn">Clear All</button></h3>

                        <div class="add-user-input-grid-header input-field-group">
                            <input class="input-field" type="text" placeholder="Full Name">
                            <input class="input-field timezone-field" type="text" placeholder="Timezones">
                            <button class="btn btn-add "> 
                                <span class="material-icons">
                                    add
                                </span>
                            </button>
                        </div>
                        <div class="add-user-input-grid">
                            <div class="input-field-group">
                                <div class="input-field">
                                    <label class="input-label  black" for="name">Full name</label>
                                    <input type="text" value="pujolsfrancis@gmail.com">
                                </div>
                                <div class="input-field timezone-field">
                                    <label class="input-label  black" for="email">Timezones</label>
                                    <input type="text" value="GTM + 1">
                                </div>
                                <button class="btn btn-add "> 
                                    <span class="material-icons">
                                        add
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';
import NewTeamMember from './new-team-member-item.vue'
export default {

    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid,
        NewTeamMember
    }
    
}
</script>
