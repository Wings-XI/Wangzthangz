FROM php:7.4-apache
RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
CMD [ "php", "./index.php" ]
