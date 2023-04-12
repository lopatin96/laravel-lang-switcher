# Install
### Publish config
```php
php artisan vendor:publish --tag="laravel-lang-switcher-config"
```
Select which variants of sections in you want. You can do it in *config/welcome-page.php*:
```json
'sections' => [
    'main' => 'v1',
    'others' => [
        [
            'name' => 'how-it-works',
            'variant' => 'v1',
        ],
        [
          'name' => 'call-to-action',
          'variant' => 'v2',
        ],
```
by specifying order of sections and their variants.

### Publish localization
```php
php artisan vendor:publish --tag="laravel-lang-switcher-lang"
```
Add local strings in *lang/vendor/welcome-page/en/<section-name-variant>.php* for selected sections.

# Publishing
### Localization
```php
php artisan vendor:publish --tag="laravel-lang-switcher-lang"
```

### Views
```php
php artisan vendor:publish --tag="laravel-lang-switcher-views"
```

### Config
```php
php artisan vendor:publish --tag="laravel-lang-switcher-config"
```