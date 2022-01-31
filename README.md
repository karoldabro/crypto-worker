# Crypto worker
It's a Laravel package that implements crypto traiding bot.

## Testing
### Run tests
```shell
docker compose run php vendor/bin/phpunit --coverage-text
```

## Generate documentation
```shell
docker compose run php vendor/bin/openapi /app/src --output docs.json
```