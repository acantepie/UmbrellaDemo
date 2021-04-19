# Umbrella Admin DEMO

Go [here](https://github.com/acantepie/umbrella) for documentation about **Umbrella framwork**.

![Screenshot of the Umbrella Admin Demo app](screenshot.png)

A demo application to showcase the main features of Umbrella framework.
 - [Online demo](https://umbrella-corp.dev/)

## Install umbrella-admin-demo

### Requirements

* PHP 7.4 or higher;
* and the [usual Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html).

### Installation

```bash
git clone git@github.com:acantepie/umbrella-admin-demo.git my_project
cd my_project/
composer install
```

Create your database :<br>
You can edit `DATABASE_URL` env var in the `.env`file to use your own credentials.

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```

Build assets:
```bash
yarn install
yarn build
yarn copy-ckeditor
```

Run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server](https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html) like Nginx or
Apache to run the application.



