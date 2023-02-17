Physical Data Model : https://aminulloh2002.github.io/assets/PhysicalDataModel.pdf
<br>
Order Activity Diagram: https://aminulloh2002.github.io/assets/VehicleOrderActivityDiagram.pdf

```
PHP_VERSION = 8.2.2
MYSQL_VERSION = 5.7.24
LARAVEL_VERSION = 10.0
COMPOSER_VERSION= 2.4.1
```

## INSTALATION

-   clone this project
-   move to project directory and run `composer install`
-   create a new database
-   rename .env.example to .env
-   update database values in the .env file with your database credentials
-   run `php artisan key:generate`
-   run `php artisann migrate`
-   run `php artisan db:seed`
-   run `php artisan serve`

## Available Roles

-   admin, can access all featues except approving vehicle order
-   approver, can only approving vehicle order
-   employee, can order vehicle and see their own orders statistics
-   supervisor, approve vehicle order and see fuel usage and vehicle order statistics of all users

## User Credentials

### Admin

-   email: admin@mail.com
-   password: password
-   role: admin

### Supervisor

-   email: supervisor@mail.com
-   password: password
-   role: supervisor

### Employee

-   email: employee@mail.com
-   password: password
-   role: employee

### Approver 1

-   email: approver1@mail.com
-   password: password
-   role: approver

### Approver 2

-   email: approver2@mail.com
-   password: password
-   role: approver

### Approver 3

-   email: approver3@mail.com
-   password: password
-   role: approver

## Vehicle Order flow

-   Employee or admin order vehicle (you will need to select approver here), after that, the order status will be pending
-   login with approver account (the one that you selecte when you create the order)
-   you can approve or reject using the approver account,
-   if you reject, the order will be rejected
-   when you approve the order, the order status will changed to "Waiting for supervisor approval)
-   as you guess it, you need to login using supervisor account and then approve or reject the order,
-   if you approve, the order status will changed to "Approved"
