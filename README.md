# Test entretien technique

### Démarrer le projet : 

docker compose up -d --build
docker exec -it test_slap_digital-php-1 bash

Une fois dans le container :
composer install
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
symfony serve --port=8000 --allow-http --no-tls --listen-ip=0.0.0.0