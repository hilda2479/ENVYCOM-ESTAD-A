# S.I.G.A Envycom

## Descripción del proyecto

**S.I.G.A Envycom** es un sistema web desarrollado para apoyar la gestión operativa del área de servicio técnico de Envycom. Su propósito principal es centralizar la información de clientes, equipos, mantenimientos, alertas y seguimiento técnico, permitiendo que los procesos internos se realicen de manera más ordenada, eficiente y confiable.

El sistema permite registrar clientes, asociar equipos a cada expediente, controlar el estatus de atención de cada equipo, programar mantenimientos, almacenar historial técnico, administrar archivos por cliente, configurar alertas automáticas por correo electrónico y consultar indicadores operativos para apoyar la toma de decisiones.

---

## Motivo del proyecto

El proyecto surge de la necesidad de mejorar el control interno del área de servicio técnico de Envycom, ya que anteriormente gran parte de la información relacionada con clientes, equipos y mantenimientos se administraba de forma manual, dispersa o poco estructurada.

Esta situación dificultaba:

- el seguimiento oportuno de los equipos ingresados,
- la consulta histórica de servicios realizados,
- la programación de mantenimientos,
- la generación de recordatorios a clientes,
- y la visualización general del estado operativo del área.

Por ello, se desarrolló **S.I.G.A Envycom** como una solución que permite organizar la información en un solo sistema, facilitar el seguimiento técnico y automatizar parte del proceso de control.

---

## Objetivo general

Desarrollar un sistema web que permita administrar de forma centralizada la información de clientes, equipos, mantenimientos y alertas dentro del área de servicio técnico de Envycom, mejorando el control operativo y facilitando el seguimiento de los servicios realizados.

---

## Funcionalidades principales

El sistema incluye actualmente las siguientes funciones:

- Registro de clientes
- Edición y consulta de clientes
- Expediente individual por cliente
- Registro de equipos por cliente
- Control de estatus de equipos
- Inventario global de equipos
- Historial técnico por equipo
- Programación de mantenimientos
- Configuración de alertas automáticas
- Envío manual y automático de correos
- Gestión de archivos por cliente
- Panel de indicadores operativos

---

## Alcance del sistema

**S.I.G.A Envycom** está orientado al apoyo de procesos internos relacionados con el servicio técnico, permitiendo:

- mantener expedientes digitales por cliente,
- consultar equipos asociados,
- dar seguimiento a mantenimientos,
- registrar intervenciones técnicas,
- almacenar archivos relacionados,
- y visualizar métricas del funcionamiento general del área.

El sistema está enfocado principalmente a uso administrativo y técnico dentro de la organización.

---

## Tecnologías utilizadas

El proyecto fue desarrollado con las siguientes tecnologías y herramientas:

### Backend
- PHP
- Laravel

### Frontend
- Blade
- Livewire
- HTML
- CSS
- JavaScript
- Vite

### Base de datos
- MySQL

### Otras herramientas
- Composer
- Node.js
- NPM
- Git
- SMTP para envío de correos electrónicos

---

## Requisitos del proyecto

Antes de instalar y ejecutar el sistema, es necesario contar con el siguiente software:

- **PHP 8.0 o superior**
- **Composer**
- **Node.js 18 o superior**
- **NPM**
- **MySQL**
- **Git**
- Un servidor local como XAMPP, Laragon o similar

---

## Instalación del proyecto

### 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
cd NOMBRE_DEL_PROYECTO
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node.js

```bash
npm install
```

### 4. Crear el archivo de entorno

Copiar el archivo `.env.example` y renombrarlo a `.env`.

En Linux o Mac:

```bash
cp .env.example .env
```

En Windows:

```bash
copy .env.example .env
```

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Configurar la base de datos en el archivo `.env`

Editar el archivo `.env` y colocar los datos correspondientes al entorno local.

Ejemplo:

```env
APP_NAME="Envycom"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siga_XXXXX
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Configurar variables de correo en el archivo `.env`

Para que el sistema pueda enviar alertas automáticas por correo, deben configurarse correctamente las variables SMTP.

Ejemplo:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=correo@dominio.com
MAIL_PASSWORD=tu_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=correo@dominio.com
MAIL_FROM_NAME="S.I.G.A Envycom"
```

> **Nota:** Si no se configuran correctamente estas variables, el módulo de alertas por correo no funcionará.

### 8. Ejecutar migraciones

```bash
php artisan migrate
```

Si el proyecto incluye seeders y necesitas datos iniciales:

```bash
php artisan db:seed
```

### 9. Crear el enlace simbólico para almacenamiento de archivos

Este paso es necesario para que funcione correctamente la carga y consulta de archivos del cliente.

```bash
php artisan storage:link
```

### 10. Compilar assets del frontend

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

### 11. Levantar el servidor Laravel

```bash
php artisan serve
```

Después de esto, el sistema estará disponible en:

```text
http://127.0.0.1:8000
```

---

## Estructura general del sistema

El sistema se organiza en los siguientes módulos principales:

### 1. Dashboard
Vista principal del sistema que muestra un resumen operativo general.

### 2. Módulo de clientes
Permite registrar, editar, consultar y administrar la información general de los clientes.

### 3. Expediente del cliente
Permite visualizar la información específica de cada cliente, sus equipos asociados y sus archivos.

### 4. Módulo de equipos
Permite registrar equipos por cliente, actualizar estatus y programar mantenimientos.

### 5. Inventario global
Permite visualizar todos los equipos registrados en una sola tabla general.

### 6. Historial técnico
Permite registrar y consultar intervenciones realizadas a cada equipo.

### 7. Alertas automáticas
Permite configurar recordatorios por mantenimiento y enviar notificaciones por correo.

### 8. Archivos del cliente
Permite cargar, descargar y eliminar archivos relacionados con el expediente del cliente.

### 9. Panel de indicadores
Muestra métricas como equipos recibidos, equipos entregados, mantenimientos vencidos, marcas frecuentes y clientes con más servicios.

---

## Flujo general de uso

El flujo básico del sistema es el siguiente:

1. El usuario inicia sesión.
2. Accede al dashboard principal.
3. Registra un cliente nuevo.
4. Ingresa al expediente del cliente.
5. Registra uno o varios equipos.
6. Asigna fecha de mantenimiento y controla el estatus del equipo.
7. Configura alertas automáticas si es necesario.
8. Registra historial técnico conforme se realizan servicios.
9. Consulta archivos y evidencia relacionada con el cliente.
10. Revisa indicadores operativos en el panel de indicadores.

---

## Variables de entorno importantes

Estas son algunas de las variables más importantes para el funcionamiento del sistema:

| Variable | Descripción |
|---------|-------------|
| `APP_NAME` | Nombre de la aplicación |
| `APP_ENV` | Entorno de ejecución |
| `APP_KEY` | Clave de Laravel |
| `APP_URL` | URL base del proyecto |
| `DB_CONNECTION` | Tipo de conexión de base de datos |
| `DB_HOST` | Servidor de base de datos |
| `DB_PORT` | Puerto de base de datos |
| `DB_DATABASE` | Nombre de la base de datos |
| `DB_USERNAME` | Usuario de la base de datos |
| `DB_PASSWORD` | Contraseña de la base de datos |
| `MAIL_MAILER` | Tipo de mailer |
| `MAIL_HOST` | Servidor SMTP |
| `MAIL_PORT` | Puerto SMTP |
| `MAIL_USERNAME` | Usuario del correo |
| `MAIL_PASSWORD` | Contraseña del correo |
| `MAIL_ENCRYPTION` | Tipo de cifrado |
| `MAIL_FROM_ADDRESS` | Correo emisor |
| `MAIL_FROM_NAME` | Nombre visible del correo |

---

## Recomendaciones para desarrollo local

- Ejecutar siempre `composer install` y `npm install` al clonar el proyecto por primera vez.
- Configurar correctamente el archivo `.env`.
- Ejecutar `php artisan migrate` después de descargar nuevos cambios que incluyan migraciones.
- Ejecutar `php artisan storage:link` para que la gestión de archivos funcione.
- Mantener activo `npm run dev` durante el desarrollo frontend.
- Usar `php artisan route:list` para consultar las rutas disponibles del sistema.

---

## Comandos útiles

### Levantar servidor Laravel
```bash
php artisan serve
```

### Levantar Vite
```bash
npm run dev
```

### Ejecutar migraciones
```bash
php artisan migrate
```

### Ver listado de rutas
```bash
php artisan route:list
```

### Crear enlace de almacenamiento
```bash
php artisan storage:link
```

### Limpiar caché de Laravel
```bash
php artisan optimize:clear
```

---

## Gestión de archivos

El sistema permite asociar archivos a cada cliente. Para que esta funcionalidad opere correctamente es indispensable:

- tener creada la tabla `documentos_clientes`,
- contar con el modelo `DocumentoCliente`,
- ejecutar `php artisan storage:link`,
- y configurar correctamente la escritura en la carpeta `storage`.

---

## Alertas automáticas

El sistema cuenta con un módulo de alertas automáticas por correo electrónico, orientado al seguimiento de mantenimientos. Estas alertas pueden configurarse para enviarse:

- varios días antes,
- un día antes,
- el mismo día,
- o cuando el mantenimiento ya se encuentre vencido.

Para que este módulo funcione correctamente, es necesario configurar las credenciales SMTP en el archivo `.env`.

---

## Panel de indicadores

El sistema incluye un panel de indicadores operativos que permite visualizar datos relevantes para la supervisión del servicio técnico. Entre los indicadores disponibles se encuentran:

- equipos recibidos por mes,
- equipos entregados,
- mantenimientos vencidos,
- tiempo promedio de reparación,
- marcas más frecuentes,
- fallas más comunes,
- clientes con más servicios.

---

## Documentación técnica adicional

Además del presente README general, el proyecto puede complementarse con documentación técnica por grupos de rutas o por módulo, por ejemplo:

- `/docs/clientes.md`
- `/docs/equipos.md`
- `/docs/alertas.md`
- `/docs/dashboard.md`
- `/docs/archivos.md`

Esto permite explicar con mayor detalle qué hace cada ruta, qué recibe, qué devuelve y qué vistas utiliza.

---

## Estado actual del proyecto

El sistema cuenta con una versión funcional que integra los componentes principales requeridos para la gestión del área de servicio técnico de Envycom. La estructura base, la navegación, la gestión de clientes y equipos, el historial técnico, la carga de archivos, las alertas y el panel de indicadores ya forman parte del proyecto.

---

## Consideraciones finales

**S.I.G.A Envycom** fue desarrollado con el propósito de ofrecer una solución práctica para la organización y seguimiento de los procesos del área de servicio técnico. Su implementación busca reducir el manejo manual de la información, mejorar el control interno y facilitar la consulta de datos relevantes para el seguimiento de clientes y equipos.

---

