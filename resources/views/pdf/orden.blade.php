<!DOCTYPE html>
<html>
<head>
    <title>Orden de Servicio - {{ $equipo->folio }}</title>
    <style>
        body { font-family: sans-serif; text-transform: uppercase; font-size: 10px; }
        .header { background: #1a1a1a; color: white; padding: 20px; text-align: center; }
        .folio { color: #DFFF00; font-size: 18px; font-weight: bold; }
        .section { margin-top: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .table { width: 100%; margin-top: 10px; border-collapse: collapse; }
        .table td { padding: 5px; border: 1px solid #ddd; }
        .footer { margin-top: 50px; text-align: center; font-style: italic; }
        .signature { margin-top: 80px; width: 200px; border-top: 1px solid black; display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ENVYCOM - SERVICIO TÉCNICO</h1>
        <div class="folio">ORDEN DE SERVICIO: {{ $equipo->folio }}</div>
    </div>

    <div class="section">
        <span class="label">CLIENTE:</span> {{ $equipo->cliente->nombre_cliente }} <br>
        <span class="label">FECHA DE INGRESO:</span> {{ $equipo->created_at->format('d/m/Y H:i') }}
    </div>

    <div class="section">
        <h3>DETALLES DEL EQUIPO</h3>
        <table class="table">
            <tr>
                <td class="label">EQUIPO</td><td>{{ $equipo->tipo_equipo }}</td>
                <td class="label">MARCA/MODELO</td><td>{{ $equipo->marca }} {{ $equipo->modelo }}</td>
            </tr>
            <tr>
                <td class="label">SERIE/SKU</td><td colspan="3">{{ $equipo->SKU }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>DIAGNÓSTICO Y CONDICIONES</h3>
        <p><span class="label">FALLAS REPORTADAS:</span><br> {{ $equipo->fallas_reportadas }}</p>
        <p><span class="label">ACCESORIOS RECIBIDOS:</span><br> {{ $equipo->accesorios }}</p>
        <p><span class="label">OBSERVACIONES TÉCNICAS:</span><br> {{ $equipo->diagnostico_inicial }}</p>
    </div>

    <div class="footer">
        <p>Al firmar, el cliente acepta las condiciones de servicio y declara que el equipo se recibe con las fallas y accesorios arriba descritos.</p>
        <div style="margin-top: 40px;">
            <div class="signature">FIRMA DEL TÉCNICO</div>
            <div style="width: 50px; display: inline-block;"></div>
            <div class="signature">FIRMA DEL CLIENTE</div>
        </div>
    </div>
</body>
</html>