Single Page Application Using Laravel, VueJS, Bootstrap, and MySQL

How to install this application?

Assuming you have installed the following dependencies:

1. Apache Server
2. MySQL Server
3. PHP 7.2 or higher
4. NPM
5. Composer

Then, you may now proceed installing the application using the following steps.

1. Clone the source code from: https://github.com/russelruiz/spa-crud.git
2. Go to application's root directory and paste the '.env' file provided by the developer. Then, configure the .env file according to your database host, username, and password.
3. While in application's root directory, run the following:
	> php artisan migrate
	> npm install
	> npm run dev
	> php artisan serve
