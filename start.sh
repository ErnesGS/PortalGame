#!/bin/bash

# Iniciar PHP-FPM
service php8.2-fpm start

# Iniciar Nginx
nginx -g 'daemon off;'
