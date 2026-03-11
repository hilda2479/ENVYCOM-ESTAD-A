<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta de mantenimiento</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f5f7; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f5f7; margin:0; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:640px; background-color:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1E2A3B; padding:28px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="left">
                                        <div style="font-size:28px; font-weight:800; color:#ffffff; letter-spacing:1px;">
                                            ENVYCOM
                                        </div>
                                        <div style="margin-top:8px; width:64px; height:6px; background-color:#DFFF00; border-radius:999px;"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 18px 0; font-size:24px; line-height:1.3; color:#1E2A3B;">
                                Hola {{ $equipo->cliente->nombre_cliente ?? 'cliente' }},
                            </h2>

                            @if($tipoAlerta === 'vencido')
                                <p style="margin:0 0 18px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                                    Te informamos que tu equipo
                                    <strong style="color:#111827;">{{ $equipo->tipo_equipo }}</strong>
                                    ya cuenta con el mantenimiento
                                    <strong style="color:#dc2626;">vencido</strong>.
                                </p>
                            @elseif($tipoAlerta === 'manual')
                                <p style="margin:0 0 18px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                                    Te enviamos este recordatorio de mantenimiento para tu equipo
                                    <strong style="color:#111827;">{{ $equipo->tipo_equipo }}</strong>.
                                </p>
                            @else
                                <p style="margin:0 0 18px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                                    Tu equipo
                                    <strong style="color:#111827;">{{ $equipo->tipo_equipo }}</strong>
                                    requiere mantenimiento en
                                    <strong style="color:#1E2A3B;">{{ $diasRestantes }} día(s)</strong>.
                                </p>
                            @endif

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:24px 0; background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:14px;">
                                <tr>
                                    <td style="padding:22px;">
                                        <p style="margin:0 0 12px 0; font-size:13px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px;">
                                            Datos del equipo
                                        </p>

                                        <p style="margin:0 0 10px 0; font-size:15px; color:#374151;">
                                            <strong style="color:#111827;">Marca:</strong> {{ $equipo->marca ?? 'N/A' }}
                                        </p>

                                        <p style="margin:0 0 10px 0; font-size:15px; color:#374151;">
                                            <strong style="color:#111827;">Modelo:</strong> {{ $equipo->modelo ?? 'N/A' }}
                                        </p>

                                        <p style="margin:0 0 10px 0; font-size:15px; color:#374151;">
                                            <strong style="color:#111827;">SKU / Serie:</strong> {{ $equipo->SKU ?? 'N/A' }}
                                        </p>

                                        <p style="margin:0 0 10px 0; font-size:15px; color:#374151;">
                                            <strong style="color:#111827;">Próximo mantenimiento:</strong>
                                            {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                                        </p>

                                        <p style="margin:0; font-size:15px; color:#374151;">
                                            <strong style="color:#111827;">Horario de atención:</strong>
                                            9:00 am a 5:00 pm
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 18px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                                Favor de comunicarte con ENVYCOM para programar tu servicio de mantenimiento y dar seguimiento oportuno a tu equipo.
                            </p>

                            <p style="margin:0; font-size:15px; line-height:1.7; color:#4b5563;">
                                Gracias por confiar en nosotros.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb; border-top:1px solid #e5e7eb; padding:24px 32px;">
                            <p style="margin:0 0 8px 0; font-size:14px; color:#6b7280;">
                                Atentamente,
                            </p>
                            <p style="margin:0; font-size:16px; font-weight:800; color:#1E2A3B;">
                                ENVYCOM
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>