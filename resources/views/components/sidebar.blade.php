<div class="sidebar">
    <h1>FSOCIETY</h1>
    <div class="container-info">
        <a href="{{ route('dashboard') }}" class="icon-info {{ request()->is('dashboard') ?  'active' : '' }}">
            <img src="{{ asset('assets/icons/dashboard.png') }}" alt="dasboard">
            Dashboard
        </a>

        <a href="{{ route('funcionario') }}" class="icon-info {{ request()->is('funcionario') ?  'active' : '' }}">
            <img src="{{ asset('assets/icons/user.png') }}" alt="dasboard">
            Funcionários
        </a>

        <a href="{{ route('produtos.index') }}" class="icon-info {{ request()->is('produto') ?  'active' : '' }}">
            <img src="{{ asset('assets/icons/inventario.png') }}" alt="dasboard">
            Produtos
        </a>

        <a href="{{ route('fornecedores.index') }}" class="icon-info {{ request()->is('fornecedores') ?  'active' : '' }}">
            <img src="{{ asset('assets/icons/fornecedor.png') }}" alt="dasboard">
            Fornecedores
        </a>

        <a href="{{ route('vendas.index') }}" class="icon-info {{ request()->is('vendas') ?  'active' : '' }}">
            <img src="{{ asset('assets/icons/vendas.png') }}" alt="dasboard">
           Vendas
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="#" class="icon-info {{ request()->is('logout') ?  'active' : '' }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <img src="{{ asset('assets/icons/exit.png') }}" alt="dasboard">
                Sair
            </a>
        </form>
    </div>
</div>