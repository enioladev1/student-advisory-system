#!/bin/sh
set -e

cd /var/www/html

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache config/routes/views for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Seed only if the users table is empty (first deploy)
USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();" 2>/dev/null | tail -1)
if [ "$USER_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

# Create storage symlink
php artisan storage:link --force 2>/dev/null || true

# Fix permissions after any volume mounts
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

exec /usr/bin/supervisord -c /etc/supervisord.conf
