<div class="login-form">
    <div class="logo">
        <!-- Adicione seu logo aqui -->
    </div>

    <div class="header">
        <h2>Entrar na conta</h2>
    </div>

    <div class="button-group">
        <!-- Botão para Administrador -->
        <a href="{{ route('admin.login') }}" class="btn {{ request()->is('login/administrator') ? 'active' : '' }}">
            <img src="{{ asset('assets/icons/user.png') }}" alt="user_icon">Admin</a>

        <!-- Botão para Funcionário -->
        <a href="{{ route('funcionario.login') }}" class="btn {{ request()->is('login/funcionarios') ? 'active' : '' }}">
            <img src="{{ asset('assets/icons/user.png') }}" alt="user_icon">Funcionário</a>
    </div>

    <div class="form-type">
        <!-- Condição para exibir o formulário correto -->
        @if (request()->is('login/administrator'))
            <!-- Formulário de Login para Administrador -->
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <input type="text" name="email" class="input" placeholder="Email" value="{{ old('email') }}">
                <input type="password" name="password" class="input" placeholder="Password">

                <div class="extra-links">
                    <a href="#">Forgot Password?</a>
                </div>

                <div class="submit">
                    <button type="submit">Sign in as Admin</button>
                </div>

                <!--Validation errors-->
                @if ($errors->any())
                    <div class="error-box">
                        <div class="alert-error">
                            @foreach ($errors->all() as $error)
                                <p>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>
        @elseif (request()->is('login/funcionarios'))
            <!-- Formulário de Login para Funcionário -->
            <form action="{{ route('funcionario.login.post') }}" method="POST">
                @csrf

                <input type="text" name="email" class="input" placeholder="Email" value="{{ old('email') }}">
                <input type="password" name="password" class="input" placeholder="Password">

                <div class="extra-links">
                    <a href="#">Forgot Password?</a>
                </div>

                <div class="submit">
                    <button type="submit">Sign in as Employee</button>
                </div>

                <!--Validation errors-->
                @if ($errors->any())
                    <div class="error-box">
                        <div class="alert-error">
                            @foreach ($errors->all() as $error)
                                <p>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>
        @else
            <!-- Mensagem padrão caso nenhuma rota seja detectada -->
            <p>Por favor, selecione uma opção de login acima.</p>
        @endif
    </div>
</div>