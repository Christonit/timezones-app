@extends('layouts.app')

@section('content')
    <div id="app" class="d-flex">
        <mobile-not-available v-if="is_mobile"></mobile-not-available>
        <users-created-modal  v-if="modal.user_created_successfully"></users-created-modal>
        <delete-project-modal v-if='modal.delete_project'></delete-project-modal>
        <delete-team-modal v-if='modal.delete_team'></delete-team-modal>
        <delete-teammate-modal v-if='modal.delete_teammate'></delete-teammate-modal>
        <new-team-modal v-if='modal.new_team'></new-team-modal>
        <edit-profile-modal v-if='modal.edit_my_profile'></edit-profile-modal>
        <change-group-name-modal v-if='modal.change_name'></change-group-name-modal>
        <name-project-category-modal v-if="modal.project_category_name"></name-project-category-modal>

        <sidebar :user="user"></sidebar>

        <router-view></router-view>

        <div class="overlay" v-if="sidebar_visible" @click="toggleSidebar"></div>
    </div>
    
@endsection