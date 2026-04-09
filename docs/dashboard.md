# Documentación de rutas - Dashboard

## Descripción general
Este grupo de rutas administra el panel principal del sistema y el panel de indicadores.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/dashboard` | `dashboard` | `DashboardController@index` | Sí | Muestra el dashboard principal del sistema | No recibe parámetros por URL | Retorna vista | `dashboard` | métricas generales, resúmenes del sistema |
| GET | `/dashboard-indicadores` | `dashboard.indicadores` | `DashboardController@indicadores` | Sí | Muestra el panel de indicadores operativos | No recibe parámetros por URL | Retorna vista | `dashboard.indicadores` | indicadores, listas y métricas operativas |

## Relación MVC

### Controlador
`DashboardController.php`

### Vistas relacionadas
- `dashboard`
- `dashboard.indicadores`

## Observaciones
- El dashboard principal concentra información general.
- El panel de indicadores presenta métricas operativas más específicas.