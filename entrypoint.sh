#!/bin/bash

set -e  # Detiene el script si algún comando falla

echo "📦 Iniciando contenedor Laravel..."

# Verifica permisos
echo "🔐 Ajustando permisos..."
chmod -R 775 storage bootstrap/cache

# Crear symlink storage si no existe
if [ ! -L "public/storage" ]; then
    echo "🔗 Enlace simbólico 'public/storage' no encontrado. Creando..."
    php artisan storage:link || echo "⚠️  No se pudo crear el enlace simbólico (puede que ya exista o esté restringido)."
else
    echo "✅ Enlace simbólico 'public/storage' ya existe."
fi

# Ejecutar migraciones (si no se hicieron en build)
echo "🛠️  Ejecutando migraciones y seeders..."
php artisan migrate --force || echo "⚠️  Migraciones fallaron (BD no disponible o ya migrada)"
php artisan db:seed --force || echo "⚠️  Seeders fallaron (opcional o ya insertados)"

# Limpiar y cachear config
echo "🧹 Limpiando y cacheando configuración de Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear archivo de log si no existe
touch storage/logs/laravel.log

# Mostrar logs en background
tail -f storage/logs/laravel.log &

# Iniciar servidor
echo "🚀 Ejecutando servidor Laravel en el puerto 8080..."
exec php -S 0.0.0.0:8080 -t public
