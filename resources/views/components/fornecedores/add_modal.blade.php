<div id="modal-fornecedor" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModal()">&times;</span>

        <div class="register-header">
            <h2>Adicionar Fornecedor</h2>
        </div>

        <form action="{{ route('fornecedores.store') }}" method="POST" class="register-form">
            @csrf
            <div class="register-field">
                <input type="text" name="name" class="register-input" placeholder="Nome" value="{{ old('name') }}" required>
                <input type="text" name="type" class="register-input" placeholder="Tipo" value="{{ old('type') }}" required>
                <input type="number" name="nuit" class="register-input" placeholder="Nuit" value="{{ old('nuit') }}" required>
                <input type="email" name="email" class="register-input" placeholder="Email" value="{{ old('email') }}" required>
                <input type="text" name="adress" class="register-input" placeholder="Endereço" value="{{ old('adress') }}" required>
                <input type="text" name="phone" class="register-input" placeholder="Contacto" value="{{ old('phone') }}" required>
                <input type="text" name="obs" class="register-input" placeholder="Observação" value="{{ old('obs') }}" required>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
