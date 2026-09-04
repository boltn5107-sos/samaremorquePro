#!/bin/sh
set -e

# Utilise le PORT fourni par Render / Railway (defaut 80)
PORT="${PORT:-80}"

echo "[SamaRemorque] Demarrage sur le port ${PORT}..."

# Permission storage / cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# Lien "public/storage" -> "storage/app/public" pour les photos / fichiers uploades
php artisan storage:link || true

# Migrations base de donnees (Render / PostgreSQL / MySQL)
# On ne lance les migrations que si APP_ENV=production ou si la variable FORCE_MIGRATE est definie
if [ "${APP_ENV:-production}" = "production" ] || [ "${FORCE_MIGRATE:-0}" = "1" ]; then
    echo "[SamaRemorque] Lancement des migrations..."
    php artisan migrate --force --no-interaction || true
fi

# Caches optimises en production
if [ "${APP_ENV:-production}" = "production" ]; then
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Adapte le port d'ecoute Nginx (support Render / Railway)
sed -i "s/listen [0-9]*;/listen ${PORT};/" /etc/nginx/http.d/default.conf

# Supervisord gere PHP-FPM + Nginx
exec /usr/bin/supervisord -c /etc/supervisord.conf
