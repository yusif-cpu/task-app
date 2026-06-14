# Laravel Task Management API

A RESTful Task Management API built with Laravel.

## Features

* User Authentication (Laravel Sanctum)
* Register / Login / Logout
* Task CRUD Operations
* Form Request Validation
* Service Layer Pattern
* API Resources
* Eloquent Relationships
* Local Query Scopes
* Events & Listeners
* Image Upload Support
* Authorization & Ownership Checks

## Technologies

* PHP
* Laravel
* SQLite
* Laravel Sanctum
* Eloquent ORM

## Installation

Clone the repository:

```bash
git clone <repository-url>
```

Install dependencies:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Create storage symlink:

```bash
php artisan storage:link
```

Start the server:

```bash
php artisan serve
```

## API Endpoints

### Authentication

* POST /api/register
* POST /api/login
* POST /api/logout

### Tasks

* GET /api/tasks
* GET /api/tasks/{id}
* POST /api/tasks
* PUT /api/tasks/{id}
* DELETE /api/tasks/{id}

## Project Structure

* Controllers: Handle HTTP requests
* Services: Business logic
* Form Requests: Validation
* Resources: API response formatting
* Events & Listeners: Task creation logging
* Models: Database interaction

### Upcoming Features

- [ ] Task Priority Levels (Low, Medium, High)
- [ ] Task Categories
- [ ] Task Status Tracking
- [ ] Task Search & Filtering
- [ ] Pagination
- [ ] Soft Deletes
- [ ] Email Notifications
- [ ] Queue Jobs
- [ ] Caching
- [ ] API Rate Limiting
- [ ] User Profile Management
- [ ] Role & Permission System

## Author

Yusif Ibrahimov
