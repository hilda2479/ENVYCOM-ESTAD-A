# Documentación de rutas - Clientes

## Descripción general
Este grupo de rutas administra el registro, edición, consulta y visualización del expediente de clientes dentro de S.I.G.A Envycom.

| Método | Ruta | Nombre | Controlador | Auth | Descripción | Parámetros | Respuesta | Vista | Datos enviados |
|--------|------|--------|-------------|------|-------------|------------|-----------|-------|----------------|
| GET | `/clientes` | `clientes.index` | `ClienteController@index` | Sí | Muestra el listado general de clientes registrados | No recibe parámetros por URL | Retorna vista | `clientes.index` | `clientes` |
| GET | `/clientes/create` | `clientes.create` | `ClienteController@create` | Sí | Muestra el formulario para registrar un nuevo cliente | No recibe parámetros por URL | Retorna vista | `clientes.create` | - |
| POST | `/clientes` | `clientes.store` | `ClienteController@store` | Sí | Guarda un nuevo cliente en la base de datos | `nombre_cliente`, `telefono`, `correo`, `sector` | Redirección con mensaje | - | - |
| GET | `/clientes/{cliente}` | `clientes.show` | `ClienteController@show` | Sí | Muestra el expediente individual del cliente | `cliente` | Retorna vista | `clientes.show` | `cliente`, relaciones asociadas |
| GET | `/clientes/{cliente}/edit` | `clientes.edit` | `ClienteController@edit` | Sí | Muestra el formulario de edición de un cliente | `cliente` | Retorna vista | `clientes.edit` | `cliente` |
| PUT/PATCH | `/clientes/{cliente}` | `clientes.update` | `ClienteController@update` | Sí | Actualiza la información del cliente seleccionado | `cliente` y campos del formulario | Redirección con mensaje | - | - |
| DELETE | `/clientes/{cliente}` | `clientes.destroy` | `ClienteController@destroy` | Sí | Elimina un cliente del sistema, según la lógica permitida | `cliente` | Redirección con mensaje | - | - |
| GET | `/clientes/{cliente}/archivos` | `clientes.archivos` | `ClienteController@archivos` | Sí | Muestra la vista de archivos asociados al cliente | `cliente` | Retorna vista | `clientes.archivos` | `cliente`, `documentos` |
| POST | `/clientes/{cliente}/archivos` | `clientes.archivos.subir` | `ClienteController@subirArchivo` | Sí | Carga un archivo y lo relaciona con el cliente | `cliente`, `archivo` | Redirección con mensaje | - | - |

## Relación MVC

### Modelo
`Cliente.php`  
Representa la entidad cliente y sus relaciones con equipos y documentos.

### Controlador
`ClienteController.php`  
Gestiona operaciones de listado, registro, edición, actualización, expediente y archivos del cliente.

### Vistas relacionadas
- `clientes.index`
- `clientes.create`
- `clientes.edit`
- `clientes.show`
- `clientes.archivos`

## Observaciones
- La vista `clientes.show` funciona como expediente general del cliente.
- Un cliente puede tener múltiples equipos asociados.
- Un cliente puede tener múltiples documentos asociados.