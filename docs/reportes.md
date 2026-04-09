# Documentación de rutas - Reportes

## Descripción general
Este grupo de rutas administra la generación de reportes por tipo o periodo.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/reporte/{tipo}` | `reportes.periodo` | `ReporteController@reportePeriodo` | Sí | Genera o muestra un reporte según el tipo solicitado | `tipo` | Retorna vista o archivo, según implementación | Según implementación | datos del reporte |

## Relación MVC

### Controlador
`ReporteController.php`

## Observaciones
- El parámetro `tipo` define el formato o categoría del reporte.
- Conviene documentar internamente qué valores acepta `tipo`.