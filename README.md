# Php-fpm-alpine x Nginx
### Symfony | Docker

Avec MariaDB & MailDev

Pour lancer le projet :
````shell
docker-compose up -d
docker exec symfony_docker composer create-project symfony/skeleton html
sudo chown -R $USER ./
````

Pensez ensuite à aller exécuter toutes vos commandes depuis l'intérieur du container.

Par exemple :
````shell
cd symfony_project
composer require orm
````
(Demandez à Composer de NE PAS créer une config Docker pour la database)

Enfin, modifiez la config DB dans le fichier .env de Symfony :
````shell
DATABASE_URL=mysql://root:ChangeMeLater@db:3306/symfony_db?serverVersion=mariadb-10.7.1
````


Se connecter à la bdd sur Bash :
````shell
mysql -uroot -p 
````

Afficher les BDD dans le BASH MYSQL:

ne jamais oublier de mettre un ';' après une commande.
````shell
show databases;
````

Afficher toutes les images de docker
````shell
    docker ps
````

Se connecter à une image avec son ID:
````shell
    docker exec -ti idImage bash
````

Pour se connecter au BASH SYMFONY:

````shell
    docker exec -ti idImage bash
    cd html
````

si jamais une entité pose probléme 
composer dump-autoload