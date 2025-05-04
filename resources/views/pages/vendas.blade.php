@extends('layouts.app')

@section('title', 'Vendas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/funcionario/funcionario.css') }}">
@endsection

@section('content')
    @include('components.produtos.table')
@endsection

@section('modals')
    @include('components.vendas.add_modal')
    @include('components.produtos.edit_modal')
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
            const modal = document.getElementById('modal-fornecedor');
            if (event.target === modal) {
                fecharModal();
            }
        }
    </script>

    <script>
        function actualizarPreco() {
            const select = document.getElementById('produto');
            const preco = select.options[select.selectedIndex].dataset.preco;
            document.getElementById('preco').value = preco;
            calcularTotal();
        }

        function calcularTotal() {
            const preco = parseFloat(document.getElementById('preco').value) || 0;
            const quantidade = parseInt(document.getElementById('quantidade').value) || 0;
            document.getElementById('total').value = (preco * quantidade).toFixed(2);
        }

        window.onload = actualizarPreco;
    </script>
@endsection
