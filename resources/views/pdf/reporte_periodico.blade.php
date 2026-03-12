<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            text-transform: uppercase;
            font-size: 10px;
            color: #333;
        }

        .header {
            border-bottom: 3px solid #DFFF00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">ENVYCOM - {{ $titulo }}</div>
        <p>Reporte generado el: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Equipo</th>
                <th>Marca</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
            <tr>
                <td style="font-weight: bold; color: #1a1a1a;">
                    {{ $equipo->folio }}
                </td>
                <td>{{ $equipo->cliente->nombre_cliente }}</td>
                <td>{{ $equipo->tipo_equipo }}</td>
                <td>{{ $equipo->marca }}</td>
                <td style="text-align: center;">{{ $equipo->estatus }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>