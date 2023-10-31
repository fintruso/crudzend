# Use a base image do PHP
FROM php:7.4-apache

# Atualize e instale as dependências do PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# Copie os arquivos do Zend Framework 2 para o contêiner
COPY . /var/www/html/

# Instale as extensões do PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Instale a extensão intl (método diferente)
RUN apt-get install -y libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Ative o módulo rewrite do Apache
RUN a2enmod rewrite

# Instale o Composer 1
RUN php -r "copy('https://getcomposer.org/download/1.10.22/composer.phar', 'composer.phar');" \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

# Exponha a porta do Apache
EXPOSE 80

# Inicie o Apache
CMD ["apache2-foreground"]
