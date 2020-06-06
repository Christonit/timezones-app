<template>
    <div class="container-fluid">
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
        
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 ">
                <div class="add-user-input-grid-header input-field-group">
                        <input class="input-field" type="text" placeholder="Full Name">
                        <input class="input-field" type="text" placeholder="Email Address">
                        <input class="input-field" type="text" placeholder="Time-zone">
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
                            <div class="input-field">
                                <label class="input-label  black" for="email">Email Address</label>
                                <input type="text" value="pujolsfrancis@gmail.com">
                            </div>
                            <div class="input-field">
                                <label class="input-label  black" for="time-zone">Time-zone</label>
                                <input type="text" value="pujolsfrancis@gmail.com">
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
</template>
<script>
import TopBar from './top-bar.vue';
import UserControlBar from './user-control-bar.vue';
import UsersCardGrid from './users-card-grid.vue';

export default {

    components:{
        TopBar,
        UserControlBar,
        UsersCardGrid
    }
    
}
</script>
