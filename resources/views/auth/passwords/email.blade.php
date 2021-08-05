@extends('layouts.app')

@section('content')

<div id="app" >

    <modal-template width-type='slim' :has_close="false">
        <div class="popup-fields-container justify-content-center">
            <h2 class="title mb--24">{{ __('Reset Password') }}</h2>

            <h3 class="text text-center">Type the email you use to sign in.</h3>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-field">
                    <label class="input-label" class="" for="email"> {{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                </div>

                @error('email')
                    <span class="text-error w-100" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="w-100 ">
                    <button class="btn btn-primary next mx-auto" type="submit">
                        <img src="/img/long-arrow.svg"/> 
                    </button>
                </div>

            </form>
        </div>
    </modal-template>
</div>

@endsection
