# FutbolDB

Aplicación web de fútbol construida con Laravel 11 + PostgreSQL.

El proyecto combina:
- consulta de datos de fútbol (clasificación y partidos recientes),
- gestión interna de ligas, equipos y jugadores,
- autenticación con roles,
- y módulos sociales básicos (foros y buscador global).

## Estado actual del proyecto

Funcionalidades implementadas:
- Autenticación completa: registro, login, verificación email, recuperación/cambio de contraseña.
- Roles `admin` y `user` con rutas protegidas.
- Inicio con clasificación por liga y partidos recientes (API externa).
- CRUD de ligas, equipos y jugadores.
- Buscador global (jugadores, equipos y ligas).
- Página de contacto mínima para incidencias/sugerencias.
- Foros básicos:
  - listado,
  - búsqueda,
  - creación de temas,
  - detalle,
  - activar/desactivar,
  - eliminación por autor o admin.
- Footer configurable desde panel admin.

## Stack técnico

- PHP `^8.2`
- Laravel `^11`
- PostgreSQL `16`
- Inertia + React
- Bootstrap + Sass
- Vite
- Pest/PHPUnit para tests

## Requisitos previos

- PHP 8.2+
- Composer
- Node.js 18+ y npm
- PostgreSQL (local o Docker)

## Instalación rápida (local)

1. Instalar dependencias:

```bash
composer install
npm install
```

2. Configurar entorno:

```bash
cp .env.example .env
php artisan key:generate
```

3. Configurar base de datos en `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=futboldb
DB_USERNAME=futboldb
DB_PASSWORD=futboldb
```

4. Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

5. Iniciar aplicación:

```bash
npm run start
```

## PostgreSQL con Docker

Levanta solo la BD:

```bash
docker compose up -d db
```

Comprobar estado:

```bash
docker compose ps
```

## API de fútbol

Para poblar datos de inicio (clasificación/partidos) necesitas:

```env
FOOTBALL_API_KEY=Clave_Unica
```

Si no hay API key o falla la conexión, la web muestra mensajes de fallback.

## Tests

La suite está configurada para PostgreSQL en `phpunit.xml`:

- `DB_CONNECTION=pgsql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=5433`
- `DB_DATABASE=futboldb_test`

Crear la BD de test (si no existe):

```bash
createdb -h 127.0.0.1 -p 5433 -U futboldb futboldb_test
```

Ejecutar tests:

```bash
php artisan test
```

## Usuario de prueba

Tras `php artisan migrate --seed`:

- Email: `javi@futboldb.com`
- Password: `password`
- Rol: `admin`

## Rutas principales

Públicas:
- `/` inicio
- `/football`
- `/welcome`
- `/contacto`

Autenticadas:
- `/players`
- `/teams`
- `/leagues`
- `/forums`
- `/search?q=...`
- `/dashboard`

Admin:
- `/admin`
- `/admin/footer`
- creación/edición/borrado de ligas, equipos y jugadores

## Comandos útiles

```bash
php artisan route:list
php artisan migrate --seed
php artisan test
./vendor/bin/pint
npm run build
```

## Notas de mantenimiento

- Los seeders de ligas/equipos usan `upsert` para evitar duplicados.
- Se añadieron índices únicos para reforzar integridad:
  - ligas por `name`
  - equipos por `name + league_id`
- El seeder de jugadores regenera jugadores por equipo en cada seed para mantener datos consistentes.
