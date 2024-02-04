FROM php:8.1-apache

# Installer les extensions PHP et autres dépendances
RUN apt-get update && apt-get install -y \
    bash git npm \
    libzip-dev \
    zip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Activer la réécriture d'URL pour Apache
RUN a2enmod rewrite

# Installation de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# installation de l'extension php mongodb
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# installation de symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Configurer le document root d'Apache pour pointer vers le dossier public de Symfony
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copier le code source de l'application dans l'image
COPY . /var/www/html


# Ajuster les permissions des dossiers var et vendor
RUN mkdir -p /var/www/html/var/cache /var/www/html/var/log /var/www/html/vendor \
  && chown -R www-data:www-data /var/www/html/var /var/www/html/vendor \
  && chmod -R 775 /var/www/html/var \
  && chmod -R 777 /var/www/

# Exécuter Composer Install (sans scripts pour éviter des erreurs liées à l'environnement)
RUN composer install --prefer-dist --no-scripts --no-dev --optimize-autoloader

# Exposez le port sur lequel le serveur web est configuré pour écouter
EXPOSE 80

WORKDIR /var/www