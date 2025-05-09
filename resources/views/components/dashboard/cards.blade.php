<p class="info">Análise rápida de dados</p>
<div class="cards">
    <div class="card">
        <img src="{{ asset('assets/icons/inventario.png') }}" alt="">
        <p>Produtos</p>
        <p class="variable">{{ $produtosDisponiveis }}</p>
    </div>

    <div class="card">
        <img src="{{ asset('assets/icons/vendas.png') }}" alt="">
        <p>Vendas hoje</p>
        <p class="variable">{{ $numeroDeVendas }}</p>
    </div>

    <div class="card">
        <img src="{{ asset('assets/icons/money.png') }}" alt="">
        <p>Receita hoje</p>
        <p class="variable">{{ number_format($totalDeVendas, 0, ',', '.') }},00MT</p>
    </div>

    @if ($userRole === 'Administrador')
        <div class="card">
            <img src="{{ asset('assets/icons/user.png') }}" alt="">
            <p>Funcionários</p>
            <p class="variable">{{ $numeroDeFuncionarios }}</p>
        </div>
    @endif

</div>
