FROM php:8.1-fpm-alpine

# installation bash
RUN apk --no-cache update \
    && apk --no-cache add bash git npm shadow autoconf g++ make openssl-dev

# installation des dépendances nécessaires et de l'extension mysqli
RUN apk --no-cache add $PHPIZE_DEPS \
    && docker-php-ext-install mysqli pdo pdo_mysql 

# installation de composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin \
    && php -r "unlink('composer-setup.php');"

# installation de l'extension php mongodb
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini

# installation de symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Définissez le répertoire de travail dans le conteneur
WORKDIR /var/www/symfony

# Copiez les fichiers de votre projet Symfony dans le conteneur
COPY . /var/www/symfony

# Installez les dépendances de votre projet avec Composer
# Si vous avez un fichier composer.lock, il est recommandé de l'utiliser
RUN composer install --no-dev --optimize-autoloader

# Exposez le port sur lequel le serveur web est configuré pour écouter
EXPOSE 9000

# Commande pour lancer le serveur PHP FPM
CMD ["php-fpm"]
