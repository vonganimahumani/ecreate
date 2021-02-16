## installation
1. Install php 7* (xamp,lamp,etc)
2. Install composer (https://getcomposer.org/doc/00-intro.md) follow all the instructions.

## setup app
1. Clone or download this repository.
2. Create database on phpadmin
3. Setup your environment
 -Create environment testing .env, and set up keys and database connection that you created on phpadmin 
 -Create environment testing .env.testing, and set up keys and database connection as follows:
    DB_CONNECTION=sqlite
    DB_DATABASE='database/test.sqlite

## commands
Open ternminal with path for project that you have cloned.

1. Run 'composer install' if its the initial setup or 'composer update'.
2. Run 'php artisan db:create.
3. Run 'php artisan migrate.
4. Run '.\vendor\bin\phpunit.bat' for testing.
5. Run 'php artisan Currency:Hourly' for cron jobs that sends emails hourly
5. Run 'php artisan serve.

Now start using app!


NB: Could not get base currency because I on free trial.
