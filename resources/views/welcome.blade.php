<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENVYCOM</title>
    
    @vite(['resources/css/bienvenida.css'])

    <meta name="theme-color" content="#6777ef">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.jpeg') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>
<body>

    <section class="hero">
        <div class="hero-text">
            <h1>SUBMAYORISTA<br>CONSULTOR DE T.I</h1>

            <p>
                SISTEMA ADMINISTRADOR DE INVENTARIO, FACTURACIÓN Y CONTROL DE CLIENTES PARA SUBMAYORISTA CONSULTOR DE T.I. OPTIMIZA TU NEGOCIO CON NUESTRA SOLUCIÓN INTEGRAL.
            </p>

            <div class="buttons">
                <a href="{{ route('login') }}" class="btn-primary">INGRESAR</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('img/bienvenida.jpeg') }}" alt="Bienvenida ENVYCOM">
        </div>
    </section>

    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(reg) {
                    console.log('Service Worker registrado con éxito: ', reg.scope);
                }, function(err) {
                    console.log('Fallo en el registro del Service Worker: ', err);
                });
            });
        }
    </script>
</body>
</html>