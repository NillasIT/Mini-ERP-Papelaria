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
                        <option value="{{ $produto->id }}" data-preco="{{ $produto->price }}" data-estoque="{{ $produto->stock }}">
                            {{ $produto->name }} (Estoque: {{ $produto->stock }})
                        </option>
                    @endforeach
                </select>

                <input type="number" name="quantidade" id="quantidade" value="1" min="1" placeholder="Quantidade" required>
                <input type="text" name="preco" id="preco" placeholder="Preço" readonly>
                <input type="text" name="total" id="total" placeholder="Total" readonly>
                <input type="text" name="funcionario" id="funcionario" value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function actualizarPreco() {
        const select = document.getElementById('produto');
        const preco = parseFloat(select.options[select.selectedIndex].dataset.preco) || 0;
        const quantidade = parseInt(document.getElementById('quantidade').value) || 1;
        document.getElementById('preco').value = preco.toFixed(2);
        document.getElementById('total').value = (preco * quantidade).toFixed(2);
    }

    function validarEstoque() {
        const select = document.getElementById('produto');
        const estoque = parseInt(select.options[select.selectedIndex].dataset.estoque) || 0;
        const quantidade = parseInt(document.getElementById('quantidade').value) || 0;

        if (quantidade > estoque) {
            alert("Quantidade excede o estoque disponível!");
            document.getElementById('quantidade').value = estoque;
        }

        actualizarPreco();
    }

    document.getElementById('produto').addEventListener('change', actualizarPreco);
    document.getElementById('quantidade').addEventListener('input', validarEstoque);
</script>