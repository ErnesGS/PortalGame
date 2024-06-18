# Usa una imagen base de Debian
FROM debian:latest

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    php \
    php-fpm \
    php-pear \
    php-dev \
    unzip \
    nginx \
    php-zip \
    php-mongodb \
    certbot \
    python3-certbot-nginx

# Instalar la extensión MongoDB para PHP
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /etc/php/8.2/fpm/php.ini

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# Configurar Nginx
COPY nginx.conf /etc/nginx/sites-available/default
COPY proyecto /var/www/html
COPY certificados /etc/nginx/ssl

# Exponer el puerto 80
EXPOSE 80
EXPOSE 443

# Copiar el script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Instalar dependencias de MongoDB con Composer
WORKDIR /var/www/html
RUN composer require mongodb/mongodb
RUN rm index.html
RUN rm index.nginx-debian.html

# Comando de inicio
CMD ["/start.sh"]
