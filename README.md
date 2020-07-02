

## About jpassesment

This is a simple application demonstrating CRUD in Laravel. 2 Models used are Employee and Company.

## Installation

- First of all, check the .env file, and set it up to fit your environment such as database name, username, password etc.
- Run migration files within database/migrations with 'php artisan migrate'. It will automatically creates all the required tables for the application.
- Run UserSeed within database/seeds with 'php artisan db:seed'. It will create admin@admin.com account for login.
- run 'php artisan storage:link' to create symbolic link for storage in public folder.
- Thats all.

## How to

On the homepage, click the login link and login using admin@admin.com with password 'password'. This admin account are created via Seeder. In addition, Register link and feature are removed as per requested.

Getting inside, there are 2 added submenu which are Employee and Company on the main top menu. These 2 are links to their respective page with list. On each page, there are Add New button to add new record for each. On the list, there are Edit button to update the record and Delete button to erase the record. For edit, form dialog will popup. This form data will be validated on the server end and errors will be returned by the Validator function if the validation fail.

## Resource

This application uses basic resources controller for the records. Refer to routes/web.php files, there are 2 routes defined as resources route for each Employee and Company.

## Front End

For front end, most of it were controlled by jQuery. Such as Edit dialog form, the data is requested with ajax to the resource endpoint such as company/2 to get the data for the company with id 2. The form submission also controlled by jQuery to avoid much redirection and keeping the map simple.

### Testing

To test this application, run 'php artisan test' or 'vendor\bin\phpunit' command. Tests were done on single data endpoint company/{?} and employee/{?}.


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# jpassesment
