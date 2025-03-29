#!/bin/bash

# Mostrar mensaje de inicio
echo "Iniciando script de post-despliegue para Railway..."

# Copiar el archivo .env.railway a .env
echo "Configurando el archivo .env para Railway..."
cp .env.railway .env

# Generar una clave de aplicación si no existe
if [ -z "$APP_KEY" ]; then
    echo "Generando APP_KEY..."
    php artisan key:generate --force
fi

# Limpiar la caché antes de optimizar
echo "Limpiando caché..."
php artisan optimize:clear

# Ejecutar comandos de Laravel necesarios para el entorno de producción
echo "Configurando optimizaciones para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Asegurarse de que las migraciones se ejecuten
echo "Ejecutando migraciones de base de datos..."
php artisan migrate --force

# Ejecutar seeders si es necesario
# php artisan db:seed --force

# Establecer permisos adecuados
echo "Estableciendo permisos adecuados..."
chmod -R 755 storage bootstrap/cache

echo "Script de post-despliegue completado exitosamente."
