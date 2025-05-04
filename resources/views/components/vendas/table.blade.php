<div class="funcionario-content-body">
    <h1>Fornecedores</h1>
    <p class="info">Gerencie os fornecedores da Repografia</p>
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
                    <th>tipo</th>
                    <th>Nuit</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Contacto</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>