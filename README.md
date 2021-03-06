# REST API (Laravel)

REST API created using <a href="https://github.com/laravel/laravel" target="_blank">Laravel 8</a>, popular web application framework.

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
#### List all categories with links and meta
```
GET api/v1/categories
```

#### List single category
```
GET api/v1/categories/{id}
```

#### Add category (Required field: name)
```
POST api/v1/categories
```

#### Update category (Required field: name)
```
PUT api/v1/categories/{id}
```

#### Delete category
```
DELETE api/v1/categories/{id}
```
---
### Posts
#### List all posts with links and meta
```
GET api/v1/posts
```

#### List single post
```
GET api/v1/posts/{id}
```

#### Add post (Required fields: title, body, category_id)
```
POST api/v1/posts
```

#### Update post (Required fields: title, body, category_id)
```
PUT api/v1/posts/{id}
```

#### Delete post
```
DELETE api/v1/posts/{id}
```
