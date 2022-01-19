# Crypto worker
It's a Laravel package that implements crypto traiding bot.

## Testing
### Run tests
```shell
docker compose run php vendor/bin/phpunit --coverage-text
```
### Develop
Determine your IP address and put it into your env variables
#### macOS:
```shell
ipconfig getifaddr en1
```
#### Windows with WSL:
```shell
grep nameserver /etc/resolv.conf | cut -d ' ' -f2
```
#### Linux (Debian based distros):
```shell
hostname -I | cut -d ' ' -f1
```
## Generate documentation
```shell
docker compose run php vendor/bin/openapi /app/src --output docs.json
```