#!/usr/bin/env bash
# Run on the server after uploading/pulling new code:  bash deploy.sh
set -euo pipefail

php artisan down --retry=60 || true
composer install --no-dev --optimize-autoloader --no-interaction
php artisan migrate --force
php artisan storage:link 2>/dev/null || true
php artisan optimize          # caches config, routes, views and events
php artisan up
echo "Deployed."
