@extends('layouts.app')

@section('content')
    <div id="app" class="d-flex">
        <sidebar></sidebar>

        <router-view></router-view>
        
        <users-created-modal  v-if="modal.user_created_successfully"></users-created-modal>
        <delete-project-modal v-if='modal.delete_group'></delete-project-modal>
        <new-team-modal v-if='modal.new_team'></new-team-modal>
        <edit-profile-modal v-if='modal.edit_my_profile'></edit-profile-modal>
        <change-group-name-modal v-if='modal.change_name'></change-group-name-modal>
        <!-- <add-email-modal ></add-email-modal> -->
        <!-- <team-created-modal></team-created-modal> -->
        <!-- <add-teammate-modal></add-teammate-modal> -->
        <!-- <edit-team-profile-modal></edit-team-profile-modal> -->

        <div class="overlay" v-if="sidebar_visible" @click="toggleSidebar"></div>
    </div>
    
@endsection