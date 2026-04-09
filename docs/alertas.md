# Documentación de rutas - Alertas

## Descripción general
Este grupo de rutas permite configurar alertas automáticas por mantenimiento y realizar envíos manuales de notificaciones por correo.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/equipos/{equipo}/configurar-alerta` | `equipos.alerta.form` | `AlertaMantenimientoController@form` | Sí | Muestra o prepara la vista/formulario para configurar la alerta de un equipo | `equipo` | Retorna vista o formulario | Según implementación | `equipo` |
| POST | `/equipos/{equipo}/configurar-alerta` | `equipos.alerta.configurar` | `AlertaMantenimientoController@configurar` | Sí | Guarda la configuración de alertas para un equipo | `equipo`, parámetros de alerta | Redirección con mensaje | - | - |
| POST | `/equipos/{equipo}/enviar-alerta` | `equipos.alerta.enviar` | `AlertaMantenimientoController@enviar` | Sí | Realiza el envío manual de una alerta al cliente | `equipo` | Redirección con mensaje | - | - |

## Relación MVC

### Modelo
Normalmente relacionado con:
- `Equipo.php`
- campos de configuración de alerta asociados al equipo

### Controlador
`AlertaMantenimientoController.php`

### Vistas relacionadas
- formulario o modal de configuración de alertas
- plantilla de correo de mantenimiento

## Observaciones
- Las alertas se configuran por equipo.
- El sistema permite envío manual además del flujo automático.
- La lógica puede considerar anticipación, mismo día y vencimiento.