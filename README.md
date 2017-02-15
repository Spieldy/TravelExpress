# Travel Express
========================

Pour installer Travel Express :

## Cloner le dépot GIT ou télécharcher l'archive.

## Installer composer :
```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

## Installer l'application :
```
cd TravelExpress
composer install
```

## Installer la base de données :
```
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
```

Le code source est situé dans src/TE/PLatformBundle.
