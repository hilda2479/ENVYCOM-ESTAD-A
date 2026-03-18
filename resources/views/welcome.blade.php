<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ENVYCOM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/bienvenida.css'])

    <!-- PWA Manifest -->
     <meta name="theme-color" content="#6777ef">
     <link rel="apple-touch-icon" href="{{ asset('img/logo.jpeg') }}">
     <link rel="manifest" href="/manifest.json">
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
            <img src="/img/bienvenida.jpeg" alt="Bienvenida ENVYCOM">
        </div>
    </section>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
            if (!navigator.serviceWorker.controller) {
                    navigator.serviceWorker.register('/sw.js').then(function(reg) {
                        console.log('Service Worker registrado con éxito:' + reg.scope);
                    });
            }
</script>
</body>

</html>