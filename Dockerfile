# Dockerfile
FROM php:8.3-apache

# Instala as extensões necessárias, incluindo PDO e PDO MySQL
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    docker-php-ext-install pdo pdo_mysql

# Instala o utilitário para habilitar o módulo de reescrita
RUN apt-get update && apt-get install -y apache2-utils

# Habilita o módulo de reescrita
RUN a2enmod rewrite

# Copia a configuração do Apache
COPY ./apache.conf /etc/apache2/apache2.conf

# Copia o arquivo de inicialização do banco de dados
COPY ./db_init.php /var/www/html/db_init.php