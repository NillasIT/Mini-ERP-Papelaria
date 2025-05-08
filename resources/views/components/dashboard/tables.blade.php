<p class="info">Últimas vendas</p>
<div class="table-data">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário (MT)</th>
                <th>Total (MT)</th>
                <th>Usuário</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ultimasVendas as $venda)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $venda->produto->name }}</td>
                    <td>{{ $venda->quantidade }}</td>
                    <td>{{ number_format($venda->preco_unitario, 2, ',', '.') }}MT</td>
                    <td>{{ number_format($venda->total, 2, ',', '.') }}MT</td>
                    <td>{{ $venda->user->name }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<p class="info">Produtos com estoque baixo</p>
<div class="table-data">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome do Produto</th>
                <th>Descrição</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtosEstoqueBaixo as $produto)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $produto->name }}</td>
                    <td>{{ $produto->description }}</td>
                    <td>{{ $produto->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
