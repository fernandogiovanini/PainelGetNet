FROM php:5.6
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

# Instala o opcache
RUN docker-php-ext-install opcache

# Instala o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala o PHPUnit
RUN composer global require phpunit/phpunit:*
ENV PATH /root/.composer/vendor/bin:$PATH
RUN ln -s /root/.composer/vendor/bin/phpunit /usr/bin/phpunit

# Instala o PHP Coding Standards Fixer
RUN composer global require fabpot/php-cs-fixer
RUN ln -s /root/.composer/vendor/bin/php-cs-fixer /usr/bin/php-cs-fixer

# Necessário para a criação de logs e cache
RUN apt-get install -y acl;
RUN usermod -u 1000 www-data

# Instalar o node e less #
RUN curl -sL https://deb.nodesource.com/setup | bash -
RUN apt-get -y install nodejs
RUN npm install -g less

# Diretório de trabalho
WORKDIR /var/www/html