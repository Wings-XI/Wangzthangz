FROM php:7.4-apache
RUN docker-php-ext-install mysqli

COPY ./public_html/ /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./index.php" ]
