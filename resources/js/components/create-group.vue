<template>
    <div class="container-fluid d-flex">

        <aside class="contact-list">

            <div class="contact-list-searchbar">
                <input type="text" class="contact-list-input" placeholder="Search"/>
                <img src="../../img/search-icon.svg" alt="" class="contact-search-icon">
            </div>

            <contact-item></contact-item>
            
        </aside>

        <div class="new-group-container w-100">
            <header class="row section-header">
                    <router-link to="/" tag="button" class="btn btn-secondary-link prev">
                        <span>
                            Cancel
                        </span>
                    </router-link>
                    
                    <h2 class="title text-center mb-0 btn-dashed-link" @click="openModal('new_team_name')">Group name</h2>
                    <continue-btn></continue-btn>
            </header>
            <div class="row">
                <div class="content ">
                    <h3 class="subtitle">Team members
                        <button class="clear-btn">Clear All</button>
                    </h3>

                    <div class="new-members-grid">
                        <new-team-member></new-team-member>
                        <new-team-member></new-team-member>
                        <new-team-member></new-team-member>
                        <new-team-member></new-team-member>
                        <new-team-member></new-team-member>
                        <new-team-member></new-team-member>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="content ">
                    <div class="add-clients-form">
                        <h3 class="subtitle">Clients <button class="clear-btn">Clear All</button></h3>
                        <button class="btn-dashed">
                           Add client 
                        </button>
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
                            <new-client-item></new-client-item>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import {mapMutations} from 'vuex';

import ContinueBtn from './utils/buttons/continue-btn.vue';

import NewTeamMember from './create-group/new-team-member-item.vue';
import ContactItem from './create-group/contact-item.vue';
import NewClientItem from './create-group/new-client-item.vue';

export default {

    components:{
        NewTeamMember,
        ContactItem,
        NewClientItem,
        ContinueBtn
    },
    methods:{
        ...mapMutations(['openModal']),

    }
    
}
</script>
