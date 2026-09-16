# ============================================================
# SamaRemorque - Dockerfile (deploiement Railway)
# Multi-stage build : compilation PHP, assets JS, image finale
# ============================================================

# ---------- Stage 1 : PHP avec extensions (base alpine) ----------
FROM php:8.3-fpm-alpine AS app

# Dependances systeme + extensions PHP
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    libpq-dev \
    nginx \
    supervisor \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql mbstring zip opcache \
    && docker-php-ext-enable opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Dependances compilées séparément (cache layer)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --prefer-dist

# Code applicatif
COPY . .

# Installation + optimisations (les assets seront copiés à l'étape suivante)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader \
    && chown -R www-data:www-data storage bootstrap/cache

# ---------- Stage 2 : Build des assets (Vite) ----------
FROM node:20-alpine AS assets

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# ---------- Stage 3 : Image finale ----------
FROM app AS final

# Conf Nginx + Supervisord + entrypoint
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Assets compilés
COPY --from=assets /app/public/build /var/www/html/public/build

# Permissions
RUN chown -R www-data:www-data /var/www/html/public/build

WORKDIR /var/www/html

# Port utilisé par Railway (configuré via PORT)
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
