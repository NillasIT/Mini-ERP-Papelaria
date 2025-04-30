@extends('layouts.app')

@section('title', 'Painel de Controle')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="sidebar">
            <h1>LOGO</h1>

            <div class="container-info">
                <a href="{{ route('painel') }}" class="icon-info {{ request()->is('painel') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/dashboard.png') }}" alt="dasboard">
                    Dashboard
                </a>

                <a href="{{ route('funcionario') }}" class="icon-info {{ request()->is('funcionarios') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/user.png') }}" alt="dasboard">
                    Funcionários
                </a>

                <a href="{{ route('inventario') }}" class="icon-info {{ request()->is('inventario') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/inventario.png') }}" alt="dasboard">
                    Produtos/Inventário
                </a>

                <a href="{{ route('funcionario') }}" class="icon-info {{ request()->is('clientes-fornecedor') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/fornecedor.png') }}" alt="dasboard">
                    Fornecedores
                </a>

                <a href="#" class="icon-info {{ request()->is('vendas') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/vendas.png') }}" alt="dasboard">
                   Vendas
                </a>

                <a href="#" class="icon-info {{ request()->is('relatorios') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/relatorio.png') }}" alt="dasboard">
                    Relatórios
                </a>

                <a href="#" class="icon-info {{ request()->is('logout') ?  'active' : '' }}">
                    <img src="{{ asset('assets/icons/exit.png') }}" alt="dasboard">
                    Sair
                </a>
            </div>
        </div>
    </div>
@endsection
