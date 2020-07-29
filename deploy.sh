#!/bin/bash
set -x
whoami
git pull
/usr/local/bin/composer install --prefer-dist --optimize-autoloader -vvv
# php artisan vendor:publish --force
php artisan view:clear
php artisan migrate
php artisan key:generate
export yearMonthDir=$(date "+%Y/%m")
export archiveDir="../archive/${yearMonthDir}"
mkdir -p $archiveDir
tar -zcvf ${archiveDir}/blog_`date "+%Y%m%d_%H%M"`.tar.gz ../blog
set +x