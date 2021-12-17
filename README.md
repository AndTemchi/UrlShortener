# Symfony Docker

A short url service based on Symfony 6.

![CI](https://github.com/AndTemchi/UrlShotener/workflows/CI/badge.svg)

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser
   and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers
6. Run `php bin/console app:init-options` in php container for initialize options

## Include

* PHP FPM
* Caddy server
* PostgreSql

### Credits

Created by [Andrey Temchishen](https://t.me/AndreyTemchishen)
