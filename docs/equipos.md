# Documentación de rutas - Equipos y mantenimientos

## Descripción general
Este grupo de rutas administra el inventario general de equipos, la configuración relacionada con equipos y el registro de mantenimientos.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/equipos-registrados` | `equipos.index` | `EquipoController@index` | Sí | Muestra el listado global o inventario general de equipos registrados | No recibe parámetros por URL | Retorna vista | Vista del inventario global | `equipos` |
| POST | `/equipos/{equipo}/mantenimientos` | `mantenimientos.store` | `MantenimientoController@store` | Sí | Registra un nuevo mantenimiento o historial técnico asociado a un equipo | `equipo` y campos del mantenimiento | Redirección con mensaje o actualización de vista | - | - |

## Relación MVC

### Modelos
- `Equipo.php`
- `Mantenimiento.php` o modelo equivalente

### Controladores
- `EquipoController.php`
- `MantenimientoController.php`

### Vistas relacionadas
- vista del inventario global
- expediente del cliente
- tabla o sección de historial técnico

## Observaciones
- Cada equipo puede tener múltiples mantenimientos.
- El inventario global centraliza la consulta de equipos registrados.
- Los mantenimientos forman parte del historial técnico del equipo.