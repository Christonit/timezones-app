@extends('layouts.app')

@section('content')
        <div id="app" class="d-flex">
            <sidebar></sidebar>
            <!-- <create-group></create-group> -->
            <router-view></router-view>
            <!-- <team-project-overview></team-project-overview> -->
            <!-- <add-new-team-member></add-new-team-member> -->

            <!-- <users-created-modal  v-if="modal.user_created_successfully"></users-created-modal> -->
            <!-- <delete-project-modal></delete-project-modal> -->
            <new-team-modal v-if='modal.new_team'></new-team-modal>
            <!-- <change-group-name-modal ></change-group-name-modal> -->
            <!-- <add-email-modal ></add-email-modal> -->
            <!-- <team-created-modal></team-created-modal> -->
            <!-- <add-teammate-modal></add-teammate-modal> -->
            <!-- <edit-team-profile-modal></edit-team-profile-modal> -->
            <!-- <edit-profile-modal></edit-profile-modal> -->
        </div>
        


        <!-- <div  class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> -->
@endsection