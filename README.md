# 🐘 What is this project?
It's a simple job posting app built with Laravel.

It is my first contact with PHP's Laravel framework, and I was **really chocked** on how amazing the framework is and how easy it makes building web applications.

This project is from the YouTube "[Laravel From Scratch 2022](https://www.youtube.com/watch?v=MYyJ4PuL4pY)" course.

The main technologies are:
- PHP
- Laravel
- MySQL database
- Tailwind CSS

![Alt text](https://github.com/bradtraversy/laragigs/raw/main/public/images/screen.png)

## Usage

### Database Setup
This app uses MySQL. To use something different, open up `config/Database.php` and change the default driver.

To use MySQL, make sure you install it, setup a database and then add your db credentials(database, username and password) to the .env.example file and rename it to .env

### Migrations
To create all the necessary tables and columns, run the following
```
php artisan migrate
```

### Seeding The Database
To add the dummy listings with a single user, run the following
```
php artisan db:seed
```

### File Uploading
When uploading listing files, they go to "storage/app/public". Create a symlink with the following command to make them publicly accessible.
```
php artisan storage:link
```

### Running the App
Upload the files to your document root, Valet folder or run 
```
php artisan serve
```