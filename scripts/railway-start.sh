#!/usr/bin/env bash
set -e

echo "[Railway] Verificando APP_KEY..."
if [ -z "${APP_KEY}" ]; then
  echo "[Railway] ERROR: APP_KEY no esta definido. Configuralo en las variables del servicio."
  exit 1
fi

echo "[Railway] Preparando aplicacion..."
php artisan storage:link --force || true
php artisan migrate --force

echo "[Railway] Iniciando servidor en 0.0.0.0:${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
