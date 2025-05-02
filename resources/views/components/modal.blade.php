<div id="modal-funcionario" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModal()">&times;</span>

        <div class="register-header">
            <h2>Adicionar Funcionário</h2>
        </div>

        <form action="{{ route('funcionario.register') }}" method="POST" class="register-form">
            @csrf
            <div class="register-field">
                <input type="text" name="name" class="register-input" placeholder="Nome" value="{{ old('name') }}" required>
                <input type="email" name="email" class="register-input" placeholder="Email" value="{{ old('email') }}" required>
                <input type="text" name="phone" class="register-input" placeholder="Contacto" value="{{ old('phone') }}" required>
                <input type="text" name="role" class="register-input" placeholder="Função" value="{{ old('role') }}" required>

                <input type="password" name="password" class="register-input" placeholder="Senha" required>
                <input type="password" name="password_confirmation" class="register-input" placeholder="Confirmar senha" required>
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
