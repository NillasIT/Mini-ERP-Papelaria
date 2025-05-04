@extends('layouts.app')

@section('title', 'Vendas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/funcionario/funcionario.css') }}">
@endsection

@section('content')
    <div class="vendas-content-body">
        <h1>Vendas</h1>

        <!-- Botão para abrir o modal de adicionar venda -->
        <div class="vendas-btn">
            <a href="#" class="btn-add" onclick="abrirModal()">
                <img src="{{ asset('assets/icons/add.png') }}" alt=""> Adicionar Venda
            </a>
        </div>

        <!-- Tabela de vendas -->
        <table id="tabela-vendas" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                    <th>Funcionário</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->produto->name }}</td>
                        <td>{{ $venda->quantidade }}</td>
                        <td>{{ $venda->preco_unitario }}</td>
                        <td>{{ $venda->total }}</td>
                        <td>{{ $venda->user->name }}</td>
                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('modals')
    @include('components.vendas.add_modal')
@endsection

@section('scripts')
    <script>
        function abrirModal() {
            document.getElementById('modal-fornecedor').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modal-fornecedor').style.display = 'none';
        }

        // Fechar ao clicar fora do conteúdo
        window.onclick = function(event) {
            const modal = document.getElementById('modal-product');
            if (event.target === modal) {
                fecharModal();
            }
        }
    </script>
@endsection
