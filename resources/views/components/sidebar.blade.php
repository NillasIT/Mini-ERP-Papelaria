<div class="sidebar">
    <h1>FSOCIETY</h1>
    <div class="container-info">
        @if (Auth::user()->role === 'Administrador')
            <a href="{{ route('dashboard') }}" class="icon-info {{ request()->is('dashboard') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/dashboard.png') }}" alt="dashboard">
                Dashboard
            </a>

            <a href="{{ route('funcionario') }}" class="icon-info {{ request()->is('funcionario') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/user.png') }}" alt="funcionários">
                Funcionários
            </a>

            <a href="{{ route('produtos.index') }}" class="icon-info {{ request()->is('produto') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/inventario.png') }}" alt="produtos">
                Produtos
            </a>

            <a href="{{ route('fornecedores.index') }}" class="icon-info {{ request()->is('fornecedor') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/fornecedor.png') }}" alt="fornecedores">
                Fornecedores
            </a>

            <a href="{{ route('vendas.index') }}" class="icon-info {{ request()->is('venda') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/vendas.png') }}" alt="vendas">
                Vendas
            </a>
        @elseif (Auth::user()->role === 'Funcionário')
            <a href="{{ route('dashboard') }}" class="icon-info {{ request()->is('dashboard') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/dashboard.png') }}" alt="dashboard">
                Dashboard
            </a>

            <a href="{{ route('produtos.index') }}" class="icon-info {{ request()->is('produto') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/inventario.png') }}" alt="produtos">
                Produtos
            </a>

            <a href="{{ route('vendas.index') }}" class="icon-info {{ request()->is('venda') ?  'active' : '' }}">
                <img src="{{ asset('assets/icons/vendas.png') }}" alt="vendas">
                Vendas
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="#" class="icon-info" onclick="event.preventDefault(); this.closest('form').submit();">
                <img src="{{ asset('assets/icons/exit.png') }}" alt="sair">
                Sair
            </a>
        </form>
    </div>
</div>