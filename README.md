# REST API (Laravel)

This is a REST API created using <a href="https://github.com/laravel/laravel" target="_blank">Laravel 8</a>, popular web application framework.

## Quick start

```
# Install dependencies
composer install

# Run migrations
php artisan migrate

# Seed data
php artisan db:seed

# Generate application key
php artisan key:generate
```

## Endpoints

### Categories
```
# List all categories with links and meta
GET api/v1/categories

# List single category
GET api/v1/categories/{id}

# Add category
POST api/v1/categories
name

# Update category
PUT api/v1/categories/{id}
name

# Delete category
DELETE api/v1/categories/{id}
```


