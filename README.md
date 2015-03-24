Travel Express
========================

Installer composer :
  curl -sS https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer

Installer l'application :
  composer install

Installer la base de données :
  php app/console doctrine:database:create
  php app/console doctrine:schema:update --force