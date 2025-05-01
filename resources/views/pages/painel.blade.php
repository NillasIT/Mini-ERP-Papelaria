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
        @include('components.dasboard-content')
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- JS do DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#minhaTabela').DataTable();
        })
    </script>
@endsection
