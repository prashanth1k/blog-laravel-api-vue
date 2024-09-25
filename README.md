# Blog Laravel Api Vue

A simple blog application built using **Laravel** (backend), **Vue.js** (frontend), **Tailwind CSS** (UI), and **MySQL** (database). The app allows users to create, view, and edit blog posts.

## Features

- **Create Posts**: Users can add new blog posts with a title and content.
- **View Posts**: All blog posts are displayed on the homepage. Users can click to view details.
- **Edit Posts**: Users can edit existing posts.
- **Responsive UI**: The application is fully responsive, styled using Tailwind CSS. Most of UI layouts is done with AI.

## Prerequisites

Ensure you have the following installed on your machine:

- [PHP 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [MySQL](https://dev.mysql.com/downloads/mysql/)

## Installation

Follow these steps to get the application up and running locally.

1. **Set up the database**:

Just create the database with the same name as in the `server/.env` file.

2. **Clone the repository**:

```bash
git clone https://github.com/prashanth1k/blog-laravel-api-vue
cd blog-laravel-api-vue/server
composer install
```

Copy over `.env.example` file to `.env` and update the database credentials.

```bash
cp .env.example .env
```

Generate application key.

```bash
php artisan key:generate
```

Run migrations.

```bash
php artisan migrate
```

3. **Install node dependencies**:

```bash
cd ../client
pnpm install
```

4. **Start the servers**:

```bash
pnpm run dev
```

In the server folder -

```bash
php artisan serve
```

The application should now be running at http://127.0.0.1:8000 ( Laravel ) and http://127.0.0.1:5173/ ( Vue application ).

## Tech Stack

- Backend: Laravel 10
- Frontend: Vue.js 3
- UI Framework: Tailwind CSS
- Database: MySQL
- API: Laravel API Resource
