<div class="dashboard-content">
    <div class="dashboard-header">
        <h1>Bem-vindo, {{ auth()->user()->name }}!</h1>

        <div class="perfil-btn">
            <a href="{{ route('profile') }}">
                <img src="{{ asset('assets/icons/profile.png') }}" alt="dasboard">
                Ver perfil
            </a>
        </div>
    </div>

    <p class="info">Analise rápida de dados</p>

    <div class="dashboard-content-body">
        <div class="cards">
            <div class="card">
                <img src="{{ asset('assets/icons/inventario.png') }}" alt="">
                <p>Produtos</p>
                <p class="variable">25</p>
            </div>

            <div class="card">
                <img src="{{ asset('assets/icons/vendas.png') }}" alt="">
                <p>Vendas hoje</p>
                <p class="variable">15 vendas</p>
            </div>

            <div class="card">
                <img src="{{ asset('assets/icons/money.png') }}" alt="">
                <p>Receita hoje</p>
                <p class="variable">2.500,00MT</p>
            </div>

            <div class="card">
                <img src="{{ asset('assets/icons/user.png') }}" alt="">
                <p>Funcionários</p>
                <p class="variable">5</p>
            </div>
        </div>

        <p class="info">Resumo de vendas</p>
        <div class="charts">
            <div class="chart">
                <!-- Canvas onde o gráfico será desenhado -->
                <canvas id="salesChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <p class="info">Últimas vendas</p>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Data</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Caneta Azul</td>
                        <td>30/04/2025</td>
                        <td>10</td>
                        <td>150 MZN</td>
                    </tr>
                    <tr>
                        <td>Papel A4 (Resma)</td>
                        <td>30/04/2025</td>
                        <td>2</td>
                        <td>600 MZN</td>
                    </tr>
                    <tr>
                        <td>Tinteiro HP</td>
                        <td>30/04/2025</td>
                        <td>1</td>
                        <td>1.200 MZN</td>
                    </tr>
                    <tr>
                        <td>Tinteiro HP</td>
                        <td>30/04/2025</td>
                        <td>1</td>
                        <td>1.200 MZN</td>
                    </tr>
                    <tr>
                        <td>Tinteiro HP</td>
                        <td>30/04/2025</td>
                        <td>1</td>
                        <td>1.200 MZN</td>
                    </tr>
                    <tr>
                        <td>Tinteiro HP</td>
                        <td>30/04/2025</td>
                        <td>1</td>
                        <td>1.200 MZN</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="info">Produtos com estoque baixo</p>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Caneta Azul</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Papel A4 (Resma)</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Tinteiro HP</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
