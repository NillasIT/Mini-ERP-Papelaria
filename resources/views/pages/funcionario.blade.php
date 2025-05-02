@extends('layouts.app')

@section('title', 'funcionarios')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/funcionario.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
                <div class="funcionario-btn">
                    <a href="#" class="btn-add" onclick="abrirModal()">
                        <img src="{{ asset('assets/icons/add.png') }}" alt="">Adicionar
                    </a>
                </div>

                <div class="table-funcionarios">
                    <table id="tabela-funcionarios" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Função</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


        </div>
    </div>
    @include('components.modal')
    @include('components.edit_modal')
@endsection

@section('scripts')
    <script>
        function abrirModal() {
            document.getElementById('modal-funcionario').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modal-funcionario').style.display = 'none';
        }

        // Fechar ao clicar fora do conteúdo
        window.onclick = function(event) {
            const modal = document.getElementById('modal-funcionario');
            if (event.target === modal) {
                fecharModal();
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#tabela-funcionarios').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Exportar PDF',
                    title: 'Relatório de Funcionários',
                    className: 'btn-export-pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3] // ignora a coluna de ações
                    }
                }],
                pageLength: 9,
                lengthMenu: [5, 10, 25, 50, 100],
                initComplete: function() {
                    this.api().columns(3).every(function() {
                        const column = this;
                        const select = $(
                                '<select><option value="">Filtrar por Função</option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function() {
                                const val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });
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
                    zeroRecords: "Nenhum funcionário encontrado"
                },
                ajax: {
                    url: '{{ route('getFuncionarios') }}',
                    dataSrc: ''
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: null,
                        className: 'actions',
                        defaultContent: `
                    <a href="#" class="btn btn-sm btn-warning btn-edit">Editar</a>
                    <a href="#" class="btn btn-sm btn-danger btn-delete">Excluir</a>
                `
                    }
                ]
            });

            // Ação de excluir funcionário
            $('#tabela-funcionarios').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const rowData = table.row($(this).parents('tr')).data();
                const id = rowData.id;

                if (confirm('Tem certeza que deseja excluir este funcionário?')) {
                    $.ajax({
                        url: `/funcionario/${id}`, // Corrigido para a rota correta
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Incluindo o token CSRF
                        },
                        success: function(response) {
                            alert(response.mensagem);
                            table.ajax.reload(); // Recarrega a tabela após a exclusão
                        },
                        error: function(error) {
                            alert('Erro ao excluir o funcionário!');
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
                    url: `/funcionario/edit/${id}`, // Rota para buscar os dados do funcionário
                    method: 'GET',
                    success: function(response) {
                        $('#funcionario-id').val(response.id);
                        $('#editar-nome').val(response.name);
                        $('#editar-email').val(response.email);
                        $('#editar-contacto').val(response.phone);
                        $('#editar-funcao').val(response.role);

                        // Atualiza a URL do formulário para a rota correta
                        $('#form-editar-funcionario').attr('action', `/funcionario/${id}`);

                        // Exibe a modal de edição
                        document.getElementById('modal-editar-funcionario').style.display =
                            'flex';
                        document.getElementById('modal-overlay').style.display = 'block';
                    },
                    error: function(error) {
                        alert('Erro ao buscar os dados do funcionário!');
                        console.error(error);
                    }
                });
            });

            // Fechar a modal de edição
            function fecharModalEditar() {
                document.getElementById('modal-editar-funcionario').style.display = 'none';
                document.getElementById('modal-overlay').style.display = 'none';
            }

            function abrirModal() {
                document.getElementById('modal-editar-funcionario').style.display = 'flex';
                document.getElementById('modal-overlay').style.display = 'block';
            }

            // Fechar a modal de edição ao clicar fora da modal (no overlay)
            window.onclick = function(event) {
                const modal = document.getElementById('modal-editar-funcionario');
                const overlay = document.getElementById('modal-overlay');
                if (event.target === modal || event.target === overlay) {
                    fecharModalEditar();
                }
            };


            // Enviar o formulário de edição via AJAX
            $('#form-editar-funcionario').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize(); // Coleta os dados do formulário

                // Envia os dados do formulário via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        alert(response.mensagem);
                        table.ajax.reload(); // Recarrega a tabela após a edição
                        fecharModalEditar(); // Fecha a modal
                    },
                    error: function(error) {
                        alert('Erro ao atualizar os dados!');
                    }
                });
            });

            // Certifique-se de que os modais estão escondidos no carregamento da página
            modalAdicionar.style.display = 'none';
            modalEditar.style.display = 'none';
        });
    </script>
@endsection
