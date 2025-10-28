#!/bin/bash
set -e

# Create php-fpm socket directory with correct permissions
mkdir -p /var/run/php
chown www-data:www-data /var/run/php

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"
