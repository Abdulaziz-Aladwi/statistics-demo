# Statistics Demo

This is a simple web app DEMO that includes Dashboard for admins who can create tasks and assign them to normal users, and a background job that update number of tasks assigned to each user.

## Prerequisites

- PHP 8.2
- Composer 2
- MySQL

## Installation
 
 1- Install dependencies using composer.

 2- Create .env file and update database configurations.
 
 3- Run "php artisan key:generate" to create application key.

 4- Create database using command "php artisan create-database {name}".

 5- Run "php artisan migrate".
 
 6- Run "php artisan optimize:clear"

 7- Run application seeders using command "php artisan db:seed".

 8- To start queue worker Run "php artisan queue:work".

 9- To run unit tests Run "php artisan test"
