#!/bin/bash

# Copiar el archivo .env.railway a .env
cp .env.railway .env

# Ejecutar comandos de Laravel necesarios para el entorno de producción
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Asegurarse de que las migraciones se ejecuten
php artisan migrate --force

# Establecer permisos adecuados
chmod -R 755 storage bootstrap/cache
