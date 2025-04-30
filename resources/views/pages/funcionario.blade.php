@extends('layouts.app')

@section('title', 'funcionarios')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/funcionario.css') }}">
@endsection

@section('content')
    <div class="container">
        @include('components.sidebar')

        <div class="funcionario-content">
            <div class="funcionario-header">
                <h1>Bem-vindo, {{ auth()->user()->name }}!</h1>

                <div class="perfil-btn">
                    <a href="{{ route('profile') }}">
                        <img src="{{ asset('assets/icons/profile.png') }}" alt="dasboard">
                        Ver perfil
                    </a>
                </div>
            </div>

            <div class="funcionario-content-body">
                <h1>Funcionários</h1>
                <p class="info">Gerencie os funcionários da Repografia</p>

                div.
            </div>
        </div>
    </div>
@endsection
