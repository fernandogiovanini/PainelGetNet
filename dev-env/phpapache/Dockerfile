FROM php:5.6-apache
MAINTAINER Fernando Giovanini <fernando@giovanini.com.br>

# Atualiza as fontes
RUN apt-get update;

# Instala biblioteca
RUN apt-get install -y libmcrypt-dev \
                      libcurl4-gnutls-dev \
                      zlib1g-dev \
                      git \
                      libpq-dev \
                      && docker-php-ext-install mcrypt \
                      && docker-php-ext-install curl \
                      && docker-php-ext-install zip \
                      && docker-php-ext-install mysql \
                      && docker-php-ext-install pdo_mysql;

# Habilita módulos do apache
RUN a2enmod rewrite

# Instala o XDEBUG
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Instala o opcache
RUN docker-php-ext-install opcache

# Necessário para a criação de logs e cache
RUN apt-get install -y acl;
RUN usermod -u 1000 www-data

# Carrega o novo vhost
ADD vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

WORKDIR /var/www/html