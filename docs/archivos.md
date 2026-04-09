# Documentación de rutas - Archivos

## Descripción general
Este grupo de rutas administra la carga, descarga y eliminación de archivos asociados al expediente del cliente.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/clientes/{cliente}/archivos` | `clientes.archivos` | `ClienteController@archivos` | Sí | Muestra la vista de gestión de archivos del cliente | `cliente` | Retorna vista | `clientes.archivos` | `cliente`, `documentos` |
| POST | `/clientes/{cliente}/archivos` | `clientes.archivos.subir` | `ClienteController@subirArchivo` | Sí | Carga un archivo y lo relaciona con el cliente | `cliente`, `archivo` | Redirección con mensaje | - | - |
| GET | `/clientes/documentos/{documento}/descargar` | `clientes.documentos.descargar` | `DocumentoClienteController@descargar` | Sí | Descarga el archivo seleccionado | `documento` | Descarga archivo | - | - |
| DELETE | `/clientes/documentos/{documento}` | `clientes.documentos.eliminar` | `DocumentoClienteController@eliminar` | Sí | Elimina el archivo del almacenamiento y de la base de datos | `documento` | Redirección con mensaje | - | - |

## Relación MVC

### Modelo
`DocumentoCliente.php`  
Representa los archivos asociados a cada cliente.

### Controladores
- `ClienteController`
- `DocumentoClienteController`

### Vistas relacionadas
- `clientes.archivos`

## Observaciones
- Un cliente puede tener múltiples archivos.
- La carga de archivos depende de la configuración de almacenamiento del proyecto.
- Requiere `php artisan storage:link` para funcionar correctamente.