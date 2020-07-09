# Partiel tests
ESGI Partiel

# Lancer le projet
`make install-dev`

Si le message "Connection refused" s'affiche dans le terminal lancer à la main 

`docker-compose exec web bash -c "bin/console doctrine:schema:update --force"`

puis 

`docker-compose exec web bash -c "php bin/console doctrine:fixture:load -n"`

# Utilisateur test

user1@gmail.com
password


# Testing
To test run : `php bin/phpunit`
