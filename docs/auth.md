# Documentación de rutas - Autenticación

## Descripción general
Este grupo de rutas corresponde a la autenticación y seguridad del sistema, gestionadas principalmente por Laravel Fortify, Jetstream, Sanctum y Livewire.

| Método | Ruta | Nombre | Controlador | Auth | Descripción |
|--------|------|--------|-------------|------|-------------|
| GET | `/login` | `login` | `AuthenticatedSessionController@create` | No | Muestra el formulario de inicio de sesión |
| POST | `/login` | - | `AuthenticatedSessionController@store` | No | Procesa el inicio de sesión |
| POST | `/logout` | `logout` | `AuthenticatedSessionController@destroy` | Sí | Cierra la sesión del usuario autenticado |
| GET | `/register` | `register` | `RegisteredUserController@create` | No | Muestra el formulario de registro |
| POST | `/register` | - | `RegisteredUserController@store` | No | Registra un nuevo usuario |
| GET | `/forgot-password` | `password.request` | `PasswordResetLinkController@create` | No | Muestra la solicitud de recuperación de contraseña |
| POST | `/forgot-password` | `password.email` | `PasswordResetLinkController@store` | No | Envía enlace de recuperación |
| GET | `/reset-password/{token}` | `password.reset` | `NewPasswordController@create` | No | Muestra formulario para restablecer contraseña |
| POST | `/reset-password` | `password.update` | `NewPasswordController@store` | No | Actualiza la contraseña |
| GET/POST | `/two-factor-challenge` | `two-factor.login` | Controladores Fortify | Según flujo | Gestiona el reto de autenticación en dos factores |

## Observaciones
- Estas rutas son generadas por Fortify/Jetstream.
- No forman parte de la lógica de negocio específica de clientes, equipos o alertas, pero sí del acceso seguro al sistema.
