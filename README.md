<p align="center"><a href="https://www.spiele-palast.de" target="_blank"><img src="https://cdn.spiele-palast.de/app/themes/spiele-palast-b4st2/theme/images/crown-large.png" width="200"></a></p>

<p align="center">
<a href="https://github.com/kadivar/user-management-app/actions/workflows/laravel.yml"><img src="https://github.com/kadivar/user-management-app/actions/workflows/laravel.yml/badge.svg" alt="Build Status"></a>
<a href="https://github.com/kadivar/user-management-app/blob/main/LICENSE.md"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<a href="https://twitter.com/mr_kadivar" title="setup-php twitter"><img alt="setup-php twitter" src="https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555"></a>
</p>

## About User Management App

`User Management App` is responsible for serving API for game clients to create a user and
access or alter the data afterwards.

### Data Schema
![Data Schema](https://github.com/kadivar/user-management-app/blob/main/data-schema.png?raw=true)

## How to initial setup

### Locally
For quick running, it's recommended to use `laravel sail`. 
For this reason first you have to be sure that you have `docker` ,`docker-compose` and `php >= 8` installed and `composer` binary is accessible on your environment. 
Just make sure that your php have `common` , `dom` and `curl` extensions.

Then you have to navigate to project path in terminal and then run these commands one by one:

- `composer install --prefer-dist --optimize-autoloader`
- `cp .env.example .env` (Just don't forget to fill values.)
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail php artisan config:clear`
- `./vendor/bin/sail php artisan migrate`
- `./vendor/bin/sail php artisan db:seed`

If need to stop all running services, it's enough to run:

`./vendor/bin/sail down`

## Running on a Production server:
  
For this case after primary infrastructure setup you need to run following commands to get application ready to use:

- `cp .env.example .env` (Just don't forget to fill values.)
- `composer install --prefer-dist --optimize-autoloader`
- `php artisan config:clear`
- `php artisan migrate`
- `php artisan db:seed`

## To do

The feature that are planned:
- [ ] Keycloak integration for have a granular ACL mechanism.


## Security Vulnerabilities

If you discover a security vulnerability within project, please send an e-mail to `Mohammadreza Kadivar` via [me.kadivar@gmail.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The User Management App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
