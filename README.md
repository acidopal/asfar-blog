# Asfar Blog
## Technical Test for Backend Developer Position


Asfar Blog built in with Laravel 11, Tailwind, & Postgresql.

## Features

- Authentication (Login, Register, Send Email Verification, etc.)
- CRUD Blog Post
- CRUD User
- CRUD Roles
- Comment On Blog Post
- Rest API - Retrieving blog posts




## Tech

Asfar Blog uses a number of open source projects to work properly:

- [Laravel 11] 
- [Tailwind] 
- [Postgresql]


## Installation

Asfar Blog requires [Laravel 11](https://laravel.com/docs/11.x) v11.x to run.

Install the dependencies and devDependencies and start the server.

```sh
git clone https://github.com/acidopal/asfar-blog.git
cd asfar-blog
composer install
yarn install / npm install
npm run build
```

## Setup .env

Copy .env.example change with your local postgres databse.

```sh
cp .env.example .env
php artisan key:generate
```

## Running Apps

Makesure your config is true, and running 2 terminal first running for laravel and second running for tailwind if you want running with hot reload.

```sh
php artisan serve
npm run dev
```

## Running DB Seeder

Before you start please run the seeder.

```sh
php artisan db:seed
```

## Account Testing

Default account based on db:seeder to test Asfar Blog Apps.

| Email | Password |
| ------ | ------ |
| admin@gmail.com | admin |


## Rest API Testing

Route for API testing.

| Method | Name | URL |
| ------ | ------ |  ------ |
| GET | List Blog Post | http://127.0.0.1:8000/api/blog-posts |
| GET | Detail Blog Post | http://127.0.0.1:8000/api/blog-posts/{id} |


