FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql intl zip xml gd curl opcache

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Ajout d'un utilisateur non-root pour le container
RUN useradd -m -u 1000 appuser

# Utiliser l'utilisateur non-root pour installer Symfony CLI
USER appuser


RUN curl -sS https://get.symfony.com/cli/installer | bash

# Ajoute le dossier Symfony CLI au PATH
ENV PATH="/home/appuser/.symfony5/bin:$PATH"

WORKDIR /var/www/html

# Expose port for PHP-FPM
EXPOSE 8000

# Ajout du Dockerfile PHP avec toutes les extensions nécessaires pour Symfony et Doctrine
