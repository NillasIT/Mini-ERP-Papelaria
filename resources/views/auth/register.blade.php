@extends('layouts.app')

@section('title', 'funcionarios')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/funcionario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register-form.css') }}">
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
                <div class="register-container">
                    <div class="register-header">
                        <h2>Registrar Funcionário</h2>
                    </div>

                    <form class="register-form" action="{{ route('funcionario.register') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="error-box">
                                <div class="alert-error">
                                    @foreach ($errors->all() as $error)
                                        <p>
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="register-field">
                            <input class="register-input" type="text" name="name" placeholder="Nome completo" value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="register-field">
                            <input class="register-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <div class="register-field">
                            <input class="register-input" type="text" name="phone" placeholder="Telefone" value="{{ old('phone') }}" required>
                        </div>

                        <div class="register-field">
                            <input class="register-input" type="password" name="password" placeholder="Senha" required>
                        </div>

                        <div class="register-field">
                            <input class="register-input" type="password" name="password_confirmation"
                                placeholder="Confirmar senha" required>
                        </div>

                        <div class="register-submit">
                            <button type="submit">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
