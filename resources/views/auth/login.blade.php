<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>S.I.G.A. - Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/login.css'])
</head>
<body>

    <div class="login-container">
        <div class="login-form-side">
            <h2>¡Bienvenido, Admin!</h2>
            <p>Ingresa tus credenciales para gestionar el sistema.</p>

            @if ($errors->any())
                <div style="color: red; margin-bottom: 20px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password">
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="remember" id="remember" style="width: auto;">
                    <label for="remember" style="margin-bottom: 0;">Recordar sesión</label>
                </div>

                <button type="submit" class="btn-login">Entrar al Sistema</button>
            </form>
        </div>

        <div class="login-image-side">
            <img src="{{ asset('img/logo-largo.jpeg') }}" alt="Login Image">
        </div>
    </div>

</body>
</html>