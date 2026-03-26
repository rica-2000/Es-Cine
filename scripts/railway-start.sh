#!/usr/bin/env bash
set -e

echo "[Railway] Verificando APP_KEY..."
if [ -z "${APP_KEY}" ]; then
  echo "[Railway] ERROR: APP_KEY no esta definido. Configuralo en las variables del servicio."
  exit 1
fi

echo "[Railway] Preparando aplicacion..."

mkdir -p bootstrap/cache
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

chmod -R ug+rw storage bootstrap/cache || true

php artisan storage:link --force || true
php artisan migrate --force

if [ "${DEMO_DATA_ON_DEPLOY,,}" = "true" ]; then
  echo "[Railway] Cargando datos demo..."
  php artisan db:seed --force
fi

echo "[Railway] Iniciando servidor en 0.0.0.0:${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
