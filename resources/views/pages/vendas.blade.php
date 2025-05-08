@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/funcionario/funcionario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendas/vendas.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="content-body">
        <h1>Vendas</h1>
        <p class="info">Gerencie as vendas da Repografia</p>
        <div class="button-position">
            <button class="btn btn-success" onclick="abrirModal()">Adicionar Venda</button>
        </div>

        <div class="modal-center">
            @include('components.vendas.add_modal')
        </div>

        @include('components.vendas.table')
    </div>
@endsection

@section('scripts')
    <script>
        function actualizarPreco() {
            const select = document.getElementById('produto');
            const preco = parseFloat(select.options[select.selectedIndex].dataset.preco) || 0;
            const quantidade = parseInt(document.getElementById('quantidade').value) || 1;
            document.getElementById('preco').value = preco.toFixed(2);
            document.getElementById('total').value = (preco * quantidade).toFixed(2);
        }

        function validarEstoque() {
            const select = document.getElementById('produto');
            const estoque = parseInt(select.options[select.selectedIndex].dataset.estoque) || 0;
            const quantidade = parseInt(document.getElementById('quantidade').value) || 0;

            if (quantidade > estoque) {
                alert("Quantidade excede o estoque disponível!");
                document.getElementById('quantidade').value = estoque;
            }

            actualizarPreco();
        }

        document.getElementById('produto').addEventListener('change', actualizarPreco);
        document.getElementById('quantidade').addEventListener('input', validarEstoque);

        function abrirModal() {
            document.getElementById('modal-fornecedor').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modal-fornecedor').style.display = 'none';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabela-funcionarios').DataTable({
                dom: 'Bfrtip',
                pageLength: 9, // Limita o número de linhas por página a 10
                buttons: [{
                        extend: 'pdfHtml5',
                        text: 'Baixar PDF',
                        title: 'Relatório de Vendas',
                        className: 'btn-export-pdf'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Baixar Excel',
                        title: 'Relatório de Vendas',
                        className: 'btn-export-pdf'
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
