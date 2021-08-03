@extends('layouts.app')

@section('content')
<div style="height: 100%;
                width: 100%;
                position: fixed;
                top: 0;
                bottom: 0;
                display: flex;
                align-items:center;
                background-color: #f8fbfb;
                z-index:9999;
                align-items: center;">
        
        <div class="container">
            <div class="row py--96">
                <div class="col-12 d-flex flex-column align-items-center  text-center">
                    <img src="{{asset('/img/404.svg')}}" class="state-img mb--48"/>
                    <h2 class="hero-title ">Oh no! </h2>
                    <h3 class="title ">We ran into some problems.</h3>
                    <p class="text mb--64">Please reload the page.</p>

                    <a href="{{route('index')}}" class="btn btn-primary next" >
                        <img src='{{asset("/img/long-arrow-reverse.svg")}}'/> 
                    </a>
                </div>
               
            </div>
        </div>
        
    
    </div>
    
@endsection