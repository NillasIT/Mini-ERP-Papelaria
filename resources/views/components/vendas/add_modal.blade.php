<div id="modal-fornecedor" class="modal" style="display: none;">
    <div class="register-container">
        <span class="close" onclick="fecharModal()">&times;</span>

        <div class="register-header">
            <h2>Adicionar Venda</h2>
        </div>

        <form action="{{ route('vendas.store') }}" method="POST" class="register-form">
            @csrf
            <div class="register-field">
                <label for="produto">Produto</label>
                <select name="produto_id" id="produto" onchange="actualizarPreco()">
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}" data-preco="{{ $produto->price }}" data-estoque="{{ $produto->stock }}">
                            {{ $produto->name }} (Estoque: {{ $produto->stock }})
                        </option>
                    @endforeach
                </select>

                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" value="1" min="1" placeholder="Quantidade" required>

                <label for="preco">Preço Unitário</label>
                <input type="text" name="preco" id="preco" placeholder="Preço" readonly>

                <label for="total">Total</label>
                <input type="text" name="total" id="total" placeholder="Total" readonly>

                <label for="funcionario">Funcionário</label>
                <input type="text" name="funcionario" id="funcionario" value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="register-submit">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

