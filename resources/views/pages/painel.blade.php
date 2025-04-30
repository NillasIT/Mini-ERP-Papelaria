@extends('layouts.app')

@section('title', 'Painel de Controle')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-content.css') }}">
@endsection

@section('content')
    <div class="container">
        @include('components.sidebar')

        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1>Bem-vindo, {{ auth()->user()->name }}!</h1>

                <div class="perfil-btn">
                    <a href="{{ route('profile') }}">
                        <img src="{{ asset('assets/icons/profile.png') }}" alt="dasboard">
                        Ver perfil
                    </a>
                </div>
            </div>

            <p class="info">Analise rápida de dados</p>

            <div class="dashboard-content-body">
                <div class="cards">
                    <div class="card">
                        <img src="{{ asset('assets/icons/inventario.png') }}" alt="">
                        <p>Produtos</p>
                        <p class="variable">25</p>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/icons/vendas.png') }}" alt="">
                        <p>Vendas hoje</p>
                        <p class="variable">15 vendas</p>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/icons/inventario.png') }}" alt="">
                        <p>Receita hoje</p>
                        <p class="variable">2.500,00MT</p>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/icons/user.png') }}" alt="">
                        <p>Funcionários</p>
                        <p class="variable">5</p>
                    </div>
                </div>

                <p class="info">Resumo de vendas</p>
                <div class="charts">
                    <div class="chart">
                        <!-- Canvas onde o gráfico será desenhado -->
                        <canvas id="salesChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        const salesChart = new Chart(ctx, {
            type: 'line', // Tipo do gráfico (linha)
            data: {
                labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'], // Eixo X (dias da semana)
                datasets: [{
                    label: 'Vendas (MT)', // Rótulo para o gráfico
                    data: [500, 750, 200, 400, 650, 300, 900], // Dados das vendas
                    backgroundColor: 'rgba(59, 130, 246, 0.2)', // Cor de fundo da área do gráfico
                    borderColor: 'rgba(59, 130, 246, 1)', // Cor da linha do gráfico
                    borderWidth: 2, // Espessura da linha
                    fill: true, // Preenchimento da área abaixo da linha
                    tension: 0.4 // Tensão da linha (curvatura)
                }]
            },
            options: {
                responsive: true, // Gráfico responsivo
                maintainAspectRatio: false, // Permite que o gráfico ocupe todo o espaço disponível
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false, // Para garantir que os rótulos do eixo X não sejam pulados
                            maxRotation: 0, // Impede que os rótulos do eixo X rotacionem
                        },
                    },
                    y: {
                        beginAtZero: true, // Começa o gráfico no zero
                    }
                }
            }
        });
    </script>
@endsection
