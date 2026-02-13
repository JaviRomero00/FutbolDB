# FutbolDB

Aplicación web de fútbol construida con Laravel 11. Permite consultar clasificaciones y partidos desde `football-data.org`, además de gestionar ligas, equipos y jugadores con autenticación y roles.

## Funcionalidades actuales
- Inicio con selector de liga y tabla de clasificación.
- Listado de partidos recientes.
- Autenticación de usuarios (registro, login, recuperación y verificación de email).
- Roles `user` y `admin` con rutas protegidas.
- CRUD de `players`, `teams` y `leagues`.
- Panel admin básico y configuración del footer.

## Requisitos
- PHP 8.2+
- Composer
- Node.js 18+ y npm
- PostgreSQL 16 (opcionalmente vía Docker)

## Puesta en marcha
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

4. (Opcional) levantar PostgreSQL con Docker:
```bash
docker compose up -d db
```

5. Migrar y sembrar datos:
```bash
php artisan migrate --seed
```

6. Configurar API key de fútbol:
```env
FOOTBALL_API_KEY=tu_api_key
```

7. Iniciar la aplicación:
```bash
npm run start
```

## Tests con PostgreSQL
Los tests están configurados para PostgreSQL en `phpunit.xml`.

1. Crear base de datos de testing:
```bash
createdb -h 127.0.0.1 -p 5433 -U futboldb futboldb_test
```

2. Ejecutar tests:
```bash
php artisan test
```

## Credenciales de prueba
Tras `php artisan migrate --seed` se crea este usuario:
- Email: `javi@futboldb.com`
- Password: `password`
- Rol: `admin`

## Rutas principales
- `/` Inicio
- `/football` Alias de inicio
- `/players` Jugadores
- `/teams` Equipos
- `/leagues` Ligas
- `/dashboard` Panel autenticado
- `/admin` Panel de administración

## Comandos útiles
```bash
php artisan test
php artisan route:list
./vendor/bin/pint
```
