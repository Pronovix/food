# Docker based Drupal site with Wodby containers

## Requirements

* git
* docker

## How to use

### First time setup

1. `git clone git@github.com:Pronovix/food.git`
1. `cd food`
1. `cp web/sites/default/example.settings.local.php web/sites/default/settings.local.php` (modify `settings.local.php` file contents to your needs)
1. `docker-compose up -d`
1. `docker-compose exec php composer install`
1. `docker-compose exec php drush si config_installer -y`
1. `docker-compose ps webserver` (take note of the port number, e.g. `32782` if the result was `0.0.0.0:32782->80/tcp`)
1. Visit `localhost:1234/` in your browser and change `1234` to the number you saw after `0.0.0.0:`, e.g. `localhost:32782/`
1. Enjoy

### Every day usage

1. Navigate to your project's folder in terminal
1. Make sure containers are up, run `docker-compose up -d`
1. `docker-compose ps webserver` (take note of the port number, e.g. `32782` if the result was `0.0.0.0:32782->80/tcp`)
1. Visit `localhost:1234/` in your browser and change `1234` to the number you saw after `0.0.0.0:`, e.g. `localhost:32782/`

#### Building && compiling the theme

* (optional, only need to do once or occasioanlly) Install packages: `docker-compose exec node yarn --cwd web/themes/custom/recipe_theme`
* Watch for changes: `docker-compose exec node yarn --cwd web/themes/custom/recipe_theme run watch`
* Build for dev env: `docker-compose exec node yarn --cwd web/themes/custom/recipe_theme run dev`
* Build for production env: `docker-compose exec node yarn --cwd web/themes/custom/recipe_theme run production`

### Running drush commands

#### Outside the php container

1. Navigate to your project's folder in terminal
1. (optional) Make sure containers are up, run `docker-compose up -d`
1. `docker-compose exec php drush DRUSHCOMMAND`, e.g. `docker-compose exec php drush cr`

#### Inside the php container

1. Navigate to your project's folder in terminal
1. (optional) Make sure containers are up, run `docker-compose up -d`
1. `docker-compose exec php bash`
1. `drush DRUSHCOMMAND`, e.g. `drush cr`

### Running composer commands

#### Outside the php container

1. Navigate to your project's folder in terminal
1. (optional) Make sure containers are up
1. `docker-compose exec php bash`
1. `composer COMPOSERCOMMAND`, e.g. `composer install`

#### Inside the php container

1. Navigate to your project's folder in terminal
1. (optional) Make sure containers are up
1. `docker-compose exec php composer COMPOSERCOMMAND`, e.g. `docker-compose exec php composer install`

### Linters

#### PHPCS (PHP code checking with Code Sniffer)

1. `docker-compose exec php ./vendor/bin/phpcs --standard=phpcs.xml`

#### PHPCBF Automatic PHP code fixing with Code Beautifier)

1. `docker-compose exec php ./vendor/bin/phpcbf --standard=phpcs.xml`

#### ESLint

1. (optional, only need to do once) `docker-compose exec node yarn`
1. `docker-compose exec node yarn run eslint .`

#### Prettier for SCSS

1. (optional, only need to do once) `docker-compose exec node yarn`
1. `docker-compose exec node yarn run prettier --write "web/themes/custom/*/src/**/*.scss"`

### Notes

* If the containers are restarted (e.g. after reboot or after `docker-compose restart`), the webserver port will change, make sure you have the right one with `docker-compose ps webserver`
