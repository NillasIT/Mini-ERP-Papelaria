<div id="modal-editar-product" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModalEditar()">&times;</span>

        <div class="register-header">
            <h2>Modificar dados de Produto</h2>
        </div>

        <form id="form-editar-product" action="#" method="POST" class="register-form">
            @csrf
            @method('PUT')
            <div class="register-field">
                <input type="text" name="name" class="register-input" id="produto-nome" placeholder="Nome" value="{{ old('name') }}" required>
                <input type="text" name="description" class="register-input" id="produto-description" placeholder="Descrição" value="{{ old('description') }}" required>
                <input type="number" name="price" class="register-input" id="produto-price" placeholder="Preço" value="{{ old('price') }}" required>
                <input type="text" name="category" class="register-input" id="produto-category" placeholder="Categoria" value="{{ old('category') }}" required>
                <input type="number" name="stock" class="register-input" id="produto-stock" placeholder="Estoque" required>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>