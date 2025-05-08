<div class="table-funcionarios">
    <table id="tabela-funcionarios" class="table table-bordered">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
                <th>Data de Venda</th>
                <th>Usuário</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <td>{{ $venda->produto->name }}</td>
                    <td>{{ $venda->quantidade }}</td>
                    <td>{{ number_format($venda->preco_unitario, 2) }}MT</td>
                    <td>{{ number_format($venda->total, 2) }}MT</td>
                    <td>{{ $venda->data_venda }}</td>
                    <td>{{ $venda->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
