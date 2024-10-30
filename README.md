# Install
### Publish config
```php
php artisan vendor:publish --tag="laravel-lang-switcher-config"
```
Add language code and names to the config *config/laravel-lang-switcher.php*:
```json
'languages' => [
  'en' => 'English',
  'ru' => 'русский',
]
```

Include lang-switcher anywhere you want, for example in your footer:
```php
@include('laravel-lang-switcher::lang-switcher.index')

// or

@include('laravel-lang-switcher::lang-switcher.index', ['align' => 'right'])
```

Add LangSwitcher middleware to middleware array in *app/Http/Kernel.php*:
```php
  protected $middleware = [
        …
        \Atin\LaravelLangSwitcher\Http\Middleware\LangSwitcher::class,
    ];
```

Publish images
```php
php artisan vendor:publish --tag="laravel-lang-switcher-images"
```

### Trait
Add **HasLocale** trait to User model

```php

use Atin\LaravelLangSwitcher\Traits\HasLocale;

class User extends Authenticatable
{
    use HasLocale, …
```

# Images
Set of images
https://flagicons.lipis.dev

### Migrations
Run migrations:
```php
php artisan migrate
```

# Publishing
### Migrations
```php
php artisan vendor:publish --tag="laravel-lang-switcher-migrations"
```

### Localization
```php
php artisan vendor:publish --tag="laravel-lang-switcher-lang"
```

### Views
```php
php artisan vendor:publish --tag="laravel-lang-switcher-views"
```

### Images
```php
php artisan vendor:publish --tag="laravel-lang-switcher-images"
```

### Config
```php
php artisan vendor:publish --tag="laravel-lang-switcher-config"
```