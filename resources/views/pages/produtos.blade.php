@extends('layouts.app')

@section('title', 'Funcionários')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/funcionario/funcionario.css') }}">
@endsection

@section('content')
    @include('components.produtos.table')
@endsection

@section('modals')
    @include('components.produtos.add_modal')
    @include('components.produtos.edit_modal')
@endsection

@section('scripts')
    <script>
        const userRole = "{{ auth()->user()->role }}";
    </script>

    <script>
        function abrirModal() {
            document.getElementById('modal-product').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modal-product').style.display = 'none';
        }

        // Fechar ao clicar fora do conteúdo
        window.onclick = function(event) {
            const modal = document.getElementById('modal-product');
            if (event.target === modal) {
                fecharModal();
            }
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
            const table = $('#tabela-funcionarios').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdfHtml5',
                        text: 'Baixar PDF',
                        title: 'Relatório de Produtos',
                        className: 'btn-export-pdf'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Baixar Excel',
                        title: 'Relatório de Produtos',
                        className: 'btn-export-pdf'
                    }
                ],

                scrollX: true, // Adiciona rolagem horizontal
                autoWidth: false, // Desativa ajuste automático de largura
                columnDefs: [{
                    targets: 0,
                    width: '20%'
                }, {
                    targets: 1,
                    width: '30%'
                }, {
                    targets: 2,
                    width: '10%'
                }, {
                    targets: 3,
                    width: '10%'
                }, {
                    targets: 4,
                    width: '10%'
                }, {
                    targets: 5,
                    width: '20%'
                }],
                pageLength: 9,
                lengthMenu: [5, 10, 25, 50, 100],
                initComplete: function() {
                    this.api().columns(3).every(function() {
                        const column = this;
                       
                    });
                },

                responsive: true,
                language: {
                    search: "Pesquisar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_",
                    paginate: {
                        first: "Primeiro",
                        last: "Último",
                        next: "Próximo",
                        previous: "Anterior"
                    },
                    zeroRecords: "Nenhum produto encontrado"
                },
                ajax: {
                    url: '{{ route('produtos.get') }}',
                    dataSrc: ''
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: null,
                        className: 'actions',
                        render: function(data, type, row) {
                            if (userRole === 'Administrador') {
                                return `
                                    <a href="#" class="btn btn-sm btn-warning btn-edit">Editar</a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete">Excluir</a>
                                `;
                            } else {
                                return ''; // Nenhum botão para outros perfis
                            }
                        }

                    }
                ]
            });

            table.buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

            // Ação de excluir funcionário
            $('#tabela-funcionarios').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const rowData = table.row($(this).parents('tr')).data();
                const id = rowData.id;

                if (confirm('Tem certeza que deseja excluir este produto?')) {
                    $.ajax({
                        url: `/produtos/${id}`, // Corrigido para a rota correta
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Incluindo o token CSRF
                        },
                        success: function(response) {
                            alert(response.mensagem);
                            table.ajax.reload(); // Recarrega a tabela após a exclusão
                        },
                        error: function(error) {
                            alert('Erro ao excluir o produto!');
                            console.error(error);
                        }
                    });
                }
            });

            // Ação de editar funcionário
            $('#tabela-funcionarios').on('click', '.btn-edit', function(e) {
                e.preventDefault();
                const rowData = table.row($(this).parents('tr')).data();
                const id = rowData.id;

                $.ajax({
                    url: `/produtos/edit/${id}`, // Rota para buscar os dados do funcionário
                    method: 'GET',
                    success: function(response) {
                        $('#produto-nome').val(response.name);
                        $('#produto-price').val(response.price);
                        $('#produto-stock').val(response.stock);
                        $('#produto-category').val(response.category);
                        $('#produto-description').val(response.description);

                        // Atualiza a URL do formulário para a rota correta
                        $('#form-editar-product').attr('action', `/produtos/${id}`);

                        // Exibe a modal de edição
                        document.getElementById('modal-editar-product').style.display =
                            'flex';
                        document.getElementById('modal-overlay').style.display = 'block';

                        // Exibe a modal de adição
                        document.getElementById('modal-product').style.display = 'flex';
                        document.getElementById('modal-overlay').style.display = 'block';
                    },
                    error: function(error) {
                        alert('Erro ao buscar os dados do produto!');
                        console.error(error);
                    }
                });
            });

            // Fechar a modal de edição
            function fecharModalEditar() {
                document.getElementById('modal-editar-product').style.display = 'none';
                document.getElementById('modal-overlay').style.display = 'none';
            }

            function abrirModal() {
                document.getElementById('modal-editar-product').style.display = 'flex';
                document.getElementById('modal-overlay').style.display = 'block';

                document.getElementById('modal-product').style.display = 'flex';
                document.getElementById('modal-overlay').style.display = 'block';
            }

            // Fechar a modal de edição ao clicar fora da modal (no overlay)
            window.onclick = function(event) {
                const modal = document.getElementById('modal-editar-product');
                const overlay = document.getElementById('modal-overlay');
                if (event.target === modal || event.target === overlay) {
                    fecharModalEditar();
                }
            };


            // Enviar o formulário de edição via AJAX
            $('#form-editar-product').on('submit', function(e) {
                e.preventDefault();

                const formData = $(this).serialize() +
                    '&_method=PUT'; // <- Adiciona o método PUT manualmente

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST', // Laravel aceita POST + _method=PUT
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        table.ajax.reload();
                        fecharModalEditar();
                    },
                    error: function(error) {
                        alert('Erro ao atualizar os dados!');
                        console.error(error.responseText);
                    }
                });
            });;

            // Certifique-se de que os modais estão escondidos no carregamento da página
            modalAdicionar.style.display = 'none';
            modalEditar.style.display = 'none';
        });
    </script>
@endsection
