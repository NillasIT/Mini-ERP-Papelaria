<div id="modal-fornecedor" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModal()">&times;</span>

        <div class="register-header">
            <h2>Adicionar Venda</h2>
        </div>

        <form action="{{ route('vendas.store') }}" method="POST" class="register-form">
            @csrf
            <div class="register-field">
                <select name="produto_id" id="produto" onchange="actualizarPreco()">
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">
                            {{ $produto->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="quantidade" id="quantidade" value="1" min="1" oninput="calcularTotal()" placeholder="Quantidade" required>
                <input type="text" name="preco" id="preco" placeholder="Preço" readonly>
                <input type="text" name="total" id="total" placeholder="Total" readonly>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
