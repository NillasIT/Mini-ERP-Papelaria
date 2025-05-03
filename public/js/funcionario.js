$(document).ready(function() {
    const table = $('#tabela-funcionarios').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pdfHtml5',
            text: 'Exportar PDF',
            title: 'Relatório de Funcionários',
            exportOptions: { columns: [0, 1, 2, 3] }
        }],
        ajax: {
            url: '/funcionarios',
            dataSrc: ''
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'role' },
            { 
                data: null,
                defaultContent: `
                    <a href="#" class="btn-edit">Editar</a>
                    <a href="#" class="btn-delete">Excluir</a>
                `
            }
        ]
    });

    
});