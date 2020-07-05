#!/bin/bash
whoami
git pull
/usr/local/bin/composer install --prefer-dist --optimize-autoloader -vvv
php artisan migrate
php artisan vendor:publish --force
php artisan view:clear