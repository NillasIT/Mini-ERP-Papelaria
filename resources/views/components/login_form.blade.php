<div class="login-form">
    <div class="logo">

    </div>

    <div class="header">
        <h2>Entrar na conta</h2>
    </div>


    <div class="button-group">
        <a href="{{ route('admin.login') }}" class="btn {{ request()->is('login/admin') ? 'active' : '' }}">
            <img src="{{ asset('assets/icons/user.png') }}" alt="user_icon">Admin</a>

        <a href="{{ route('funcionario.login') }}" class="btn {{ request()->is('login/funcionario') ? 'active' : '' }}">
            <img src="{{ asset('assets/icons/user.png') }}" alt="user_icon">Funcionário</a>
    </div>

    <div class="form-type">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <input type="text" name="email" class="input" placeholder="Email" value="{{ old('email') }}">
            <input type="password" name="password" class="input" placeholder="Password">

            <div class="extra-links">
                <a href="#">Forgot Password?</a>
            </div>

            <div class="submit">
                <button type="submit">Sign in</button>
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
    </div>
</div>
