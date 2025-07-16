1. docker network create library-project
2. override docker-compose.override.yaml
3. docker compose up -d
4. docker compose exec -it library-php ./bin/console doctrine:migrations:migrate
