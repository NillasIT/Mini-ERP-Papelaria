@extends('layouts.app')

@section('title', 'Login Page')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="left-column">
            <img src="{{ asset('assets/images/Info.png') }}" alt="">
        </div>

        <div class="right-column">
            <div class="container-form">
                @include('components.login_form')
            </div>
        </div>
    </div>
@endsection
