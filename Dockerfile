# Usamos la imagen oficial de PHP 8.3 con FPM
FROM php:8.3-fpm

# Argumentos (pueden ser útiles)
ARG user=sail
ARG uid=1000

# Instalamos dependencias del sistema y extensiones de PHP para Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos las extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Obtenemos e instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creamos un usuario para ejecutar la aplicación
RUN groupadd -g $uid $user
RUN useradd -u $uid -ms /bin/bash -g $user $user

# Cambiamos al directorio de trabajo
WORKDIR /var/www/html

# Cambiamos el propietario de los archivos al nuevo usuario
USER $user