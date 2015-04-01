Travel Express
========================

Pour installer Travel Express :

1. Cloner le dépot GIT ou télécharcher l'archive.

2. Installer composer :
```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

3. Installer l'application :
```
cd TravelExpress
composer install
```

4. Installer la base de données :
```
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
```

Le code source est situé dans src/TE/PLatformBundle.
