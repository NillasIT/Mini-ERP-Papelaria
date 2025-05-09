<div class="funcionario-content-body">
    <h1>Produtos</h1>
    <p class="info">Gerencie os produtos da Repografia</p>
    @if (auth()->user()->role === 'Administrador')
        <div class="funcionario-btn">
            <a href="#" class="btn-add" onclick="abrirModal()">
                <img src="{{ asset('assets/icons/add.png') }}" alt="">Adicionar
            </a>
        </div>
    @endif

    <div class="table-funcionarios">
        <table id="tabela-funcionarios" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço (MT)</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
