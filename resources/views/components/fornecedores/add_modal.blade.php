<div id="modal-product" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModal()">&times;</span>

        <div class="register-header">
            <h2>Adicionar Fornecedor</h2>
        </div>

        <form action="{{ route('fornecedores.store') }}" method="POST" class="register-form">
            @csrf
            <div class="register-field">
                <input type="text" name="name" class="register-input" placeholder="Nome" value="{{ old('name') }}" required>
                <input type="text" name="description" class="register-input" placeholder="Descrição" value="{{ old('description') }}" required>
                <input type="number" name="price" class="register-input" placeholder="Preço" value="{{ old('price') }}" required>
                <input type="text" name="category" class="register-input" placeholder="Categoria" value="{{ old('category') }}" required>
                <input type="number" name="stock" class="register-input" placeholder="Estoque" required>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
