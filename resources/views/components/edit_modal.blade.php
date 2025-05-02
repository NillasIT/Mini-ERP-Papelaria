<div id="modal-editar-funcionario" class="modal">
    <div class="register-container">
        <span class="close" onclick="fecharModalEditar()">&times;</span>

        <div class="register-header">
            <h2>Modificar dados do Funcionário</h2>
        </div>

        <form id="form-editar-funcionario" action="#" method="POST" class="register-form">
            @csrf
            @method('PUT')
            <div class="register-field">
                <input type="hidden" name="id" id="funcionario-id">
                <input type="text" name="name" id="editar-nome" class="register-input" placeholder="Nome" required>
                <input type="email" name="email" id="editar-email" class="register-input" placeholder="Email" required>
                <input type="text" name="phone" id="editar-contacto" class="register-input" placeholder="Contacto" required>
                <input type="text" name="role" id="editar-funcao" class="register-input" placeholder="Função" required>
                <input type="password" name="password" class="register-input" placeholder="Senha">
                <input type="password" name="password_confirmation" class="register-input" placeholder="Confirmar senha">
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>