## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/mustafaAnwar2020/LaraBlog.git
composer install
cp .env.example .env
add NOCAPTCHA
```
(You can obtain it from [here](https://github.com/anhskohbo/no-captcha))

Then create the necessary database.

```
php artisan db
create database blog
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```

when u create your first user go to ```is_admin``` column in users table and edit it to 1 

with Admin permissions you can 

1 - add new users with their roles (admin/user) 

2 - edit/delete any post/user 

3 - add/edit/delete Tags
