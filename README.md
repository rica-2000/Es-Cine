# Cine

Sistema web para gestion de cine desarrollado con Laravel 12, Livewire y MySQL.

Permite administrar sucursales, salas, peliculas y funciones, con dashboard de indicadores y soporte de importacion/reporte.

## Funcionalidades

- Autenticacion y verificacion de usuario.
- Gestion CRUD de sucursales.
- Gestion CRUD de salas.
- Gestion CRUD de peliculas.
- Importacion de peliculas desde Excel/CSV.
- Gestion CRUD de funciones.
- Dashboard con metricas y graficas.
- Generacion de reporte de peliculas por sala.
- Notificacion por correo al crear una pelicula.

## Stack Tecnologico

- Backend: Laravel 12 (PHP 8.2)
- Frontend: Blade, Livewire, Tailwind, Vite
- Base de datos: MySQL
- Librerias clave: Laravel Fortify, Laravel Excel, DomPDF

## Requisitos

- PHP 8.2+
- Composer 2+
- Node.js 20+
- NPM 10+
- MySQL 8+

## Instalacion Local

1. Clona el repositorio.
2. Instala dependencias de PHP:

```bash
composer install
```

3. Instala dependencias de frontend:

```bash
npm install
```

4. Crea archivo de entorno:

```bash
cp .env.example .env
```

5. Configura variables de base de datos en `.env`.
6. Genera la llave de aplicacion:

```bash
php artisan key:generate
```

7. Ejecuta migraciones:

```bash
php artisan migrate
```

8. Levanta el entorno de desarrollo:

```bash
composer run dev
```

## Datos Demo

Existe una migracion de datos demo pensada para despliegue en Railway:

- `database/migrations/2026_03_26_120000_insert_demo_cine_data.php`

Se ejecuta solo cuando se cumplen ambas condiciones:

- El entorno es Railway.
- `DEMO_DATA_ON_DEPLOY=true`.

## Despliegue en Railway

El proyecto incluye dos rutas de despliegue:

- `Dockerfile` (recomendada): instala extensiones necesarias como `gd` y `zip`.
- `nixpacks.toml`: configuracion alternativa con Nixpacks.

### Variables de entorno recomendadas

```env
APP_NAME=Cine
APP_ENV=production
APP_DEBUG=false
APP_URL=https://TU_DOMINIO_PUBLICO
APP_KEY=base64:TU_APP_KEY

DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=TU_PASSWORD

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

DEMO_DATA_ON_DEPLOY=true

LOG_CHANNEL=stack
LOG_LEVEL=info
```

### Flujo recomendado

1. Conecta el repositorio en Railway.
2. Agrega servicio MySQL al proyecto.
3. Configura variables de entorno.
4. Verifica que el servicio use el `Dockerfile`.
5. Ejecuta Deploy o Redeploy.
6. Comprueba salud en `/up`.

## Scripts Utiles

```bash
# Desarrollo (server + queue + vite)
composer run dev

# Pruebas
composer run test

# Build frontend
npm run build
```

## Estructura Principal

- `app/Http/Controllers`: logica de controladores.
- `app/Models`: modelos del dominio.
- `database/migrations`: estructura y evolucion de la BD.
- `resources/views`: vistas Blade del sistema.
- `routes/web.php`: rutas web de la aplicacion.

## Notas

- Si rotas credenciales o `APP_KEY`, actualiza variables en Railway y redeploya.
- En produccion, mantener siempre `APP_DEBUG=false`.
