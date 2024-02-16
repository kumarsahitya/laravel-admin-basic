
# Laravel Admin

Laravel Admin is a web application build with [Laravel Shopper](https://github.com/shopperlabs/shopper) and [Sneat - Free Bootstrap 5 HTML Admin Template](https://github.com/themeselection/sneat-bootstrap-html-admin-template-free). It is complete solution for your store to make online, with managing frontend and backend.

## Pre Requirements

-   Docker
-   npm
-   yarn

## Installation ⚒️

1. First of all, make sure you have installed [Node](https://nodejs.org/en/) (LTS). If Node.js is already installed in your system, make sure the installed version is `LTS` and jump to step 2

2. Install the Composer Packages: Open Terminal/Command Prompt and run the following command and wait until it finishes. It will install required packages like laravel.

```bash
composer install
```

3. Navigate to the Laravel Admin root directory and run the following command to install our local dependencies listed in `package.json`. You can use `npm` OR `yarn` as per your preference.

> It is recommended to use Yarn

```bash
# For npm
npm install

# For Yarn
yarn install
```

4. Rename file `.env.example` to `.env` Set configuration in `.env` File: Change below variables for connect Database, Google Analytics, Facebook Pixel, and Google Tag Manager.

```bash
DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

5. Setting environment: Once you set your `.env` file Run below commands for generate APP_KEY, and make storage folder as linkable.

```bash
# If you are using Docker please go into php bash
docker-compose exec laravel.test bash

# Generate APP KEY
php artisan key:generate

# Make storeage directory link
php artisan storage:link
```

6. Database Migrations: Run below commands for migrate database.

```bash
# If you are using Docker please go into php bash
docker-compose exec laravel.test bash

# Run migration
php artisan migrate --seed
```

7. Serve Project: To run Laravel Admin run below command and wait until it finishes. You can use `npm` OR `yarn` as per your preference.

> It is recommended to use Yarn

```bash
# For npm
npm run dev

# For Yarn
yarn run development
```

8. Run Project & Login: Run below command to run the project and you can hit given URL as output in your web browser.

```bash
# For Run
php artisan serve
```

```bash
# For Log in
Email: admin@example.com
Password: Pass@123
```

9.  Enjoy :relieved:


## Multiple Entity

-   For Run Database migration: Run below commands
```bash
# If you are using Docker please go into php bash
docker-compose exec laravel.test bash

# for run migration
php artisan migrate:fresh --seed --env=<EntityName>
```

## Foundation library

- The Laravel Admin uses [Laravel](https://laravel.com) as a foundation PHP framework.
- The Laravel Admin uses and inspired by [Sneat - Free Bootstrap 5 HTML Admin Template](https://github.com/themeselection/sneat-bootstrap-html-admin-template-free) as a Admin Template.

### Run Test Cases 

```
php artisan test --coverage-html reports/unit --profile
```
```
./vendor/bin/pest --coverage-html reports/unit --profile
```
