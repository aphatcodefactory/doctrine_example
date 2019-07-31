# doctrine_example
doctrine (with crud) from scratch: \n
1.) php bin/console doctrine:database:create
2.) php bin/console doctrine:generate:entity
3.) (php bin/console doctrine:schema:validate)
    php bin/console doctrine:schema:update --force
4.) php bin/console doctrine:schema:validate
5.) php bin/console doctrine:generate:crud