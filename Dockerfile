FROM php:8.2-apache AS base
COPY ./src /var/www/html
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite
EXPOSE 80
# ENTRYPOINT [ "docker-php-entrypoint apache2-foreground" ]