<!-- Overlay -->
<div id="modal-overlay" class="modal-overlay" style="display: none;"></div>

<!-- Modal de Edição -->
<div id="modal-editar-funcionario" class="modal" style="display: none;">
    <div class="register-container">
        <span class="close" onclick="fecharModalEditar()">&times;</span>

        <div class="register-header">
            <h2>Modificar dados do Funcionário</h2>
        </div>

        <!-- O formulário agora tem uma ação dinâmica -->
        <form id="form-editar-funcionario" action="#" method="POST" class="register-form">
            @csrf
            @method('PUT')
            <div class="register-field">
                <input type="text" name="name" id="funcionario-nome" class="register-input" placeholder="Nome" required>
                <input type="email" name="email" id="funcionario-email" class="register-input" placeholder="Email" required>
                <input type="text" name="phone" id="funcionario-phone" class="register-input" placeholder="Contacto" required>
                <input type="text" name="role" id="funcionario-role" class="register-input" placeholder="Função" required>

                <input type="password" name="password" id="funcionario-password" class="register-input" placeholder="Senha">
                <input type="password" name="password_confirmation" id="funcionario-password_confirmation" class="register-input" placeholder="Confirmar senha">
            </div>

            <div class="register-submit">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
