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
6. Generowanie JWT
   ```bash
    docker compose exec -it library-php ./bin/console lexik:jwt:generate-keypair
7. Override .env.local JWT_PASSPHRASE
8. Test login -> /api/auth/login
```
{
  "email": "eryk.librarian@gmail.com",
  "password": "LIBRARIAN"
}
```

```
{
  "email": "eryk.member@gmail.com",
  "password": "MEMBER"
}
```
9. Test -> /api/books?currentPage=1&pageSize=5&author=Accusamus
10. Test -> /api/books/{id}





#### Run php-cs-fixer
```bash
docker compose exec -it library-php ./vendor/bin/php-cs-fixer fix src
```
