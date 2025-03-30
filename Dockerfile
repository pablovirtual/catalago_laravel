FROM php:8.2-fpm

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json y composer.lock
COPY composer*.json ./

# Instalar dependencias sin realizar scripts y no mostrar mensajes 
RUN composer install --prefer-dist --no-scripts --no-progress --no-interaction --no-dev

# Copiar código fuente
COPY . .

# Copiar y hacer ejecutable el script post-deploy.sh
COPY post-deploy.sh /var/www/html/post-deploy.sh
RUN chmod +x /var/www/html/post-deploy.sh

# Instalar dependencias de npm y construir activos
RUN npm install && npm run build

# Dar permisos a las carpetas de almacenamiento y caché
RUN chmod -R 775 storage bootstrap/cache

# Exponer puerto 8000
EXPOSE 8000

# Comando de inicio
CMD ["sh", "-c", "./post-deploy.sh && php -S 0.0.0.0:${PORT:-8000} -t public"]
