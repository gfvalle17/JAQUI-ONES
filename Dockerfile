# Usamos la imagen oficial de PHP 8.3 con FPM
FROM php:8.3-fpm

# Argumentos para el usuario
ARG user=sail
ARG uid=1000

# Instalamos dependencias del sistema y extensiones de PHP en un solo paso
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Obtenemos e instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creamos un usuario para ejecutar la aplicación
RUN groupadd -g $uid $user \
    && useradd -u $uid -ms /bin/bash -g $user $user

# Cambiamos al directorio de trabajo
WORKDIR /var/www/html

# Cambiamos el propietario de los archivos al nuevo usuario
USER $user