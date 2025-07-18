1. Stwórz sieć Docker:
   ```bash
   docker network create library-project
2. override docker-compose.override.yaml
3. Uruchom kontenery:
   ```bash
   docker compose up -d
4. Wykonaj migracje bazy danych:
   ```bash
    docker compose exec -it library-php ./bin/console doctrine:migrations:migrate
5. Załaduj dane testowe:
   ```bash
    docker compose exec -it library-php ./bin/console doctrine:fixtures:load
