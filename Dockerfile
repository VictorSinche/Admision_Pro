# --------------------------
# ETAPA BASE: PHP + Extensiones
# --------------------------
FROM php:8.2-cli

# Instalar dependencias del sistema y extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath zip xml \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js para compilar assets
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos del proyecto
COPY . .

# Aumentar límite de memoria para Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Instalar dependencias PHP (sin ejecutar scripts aún)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# 🔥 Evitamos sobrescribir el .env de Railway y saltamos config específica local
# RUN cp .env.example .env \
#     && sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env \
#     && php artisan key:generate --ansi || echo "⚠️ key:generate falló"

# Ejecutar autodiscovery de paquetes (no crítico si falla)
RUN php artisan package:discover --ansi || echo "⚠️ package:discover falló"

# Instalar dependencias JS y compilar assets
RUN npm install --legacy-peer-deps && npm run build

# Cache de Laravel (sin migraciones aquí)
RUN php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Crear carpetas necesarias con permisos
RUN mkdir -p storage/app/public bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copiar script de arranque
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exponer el puerto esperado por Railway
EXPOSE 8080

# Iniciar usando el script
CMD ["/entrypoint.sh"]
