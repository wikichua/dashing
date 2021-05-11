# Dashing

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [progress.md](wiki/progress.md) to see a to do list.

## Installation

Via Composer

Notes: I do not plan to released this to packagist. But that wont's stop us to install via composer!

Add this into your composer.json

```json
    "repositories": {
        "wikichua/dashing": {
            "type": "vcs",
            "url": "https://github.com/wikichua/dashing.git"
        }
    }
```

Run in your bash

```bash
mysql -uhomestead -p <<_EOF_
CREATE DATABASE *YourDatabase*;
_EOF_
laravel new *YourProject*
```

Ammend your .env

```env
APP_URL=https://*yourproject.test*
DB_DATABASE=*YourDatabase*
```

Run in your bash

```bash
composer require wikichua/dashing
php artisan storage:link
php artisan dashing:install
```

In your app/User.php

```php
class User extends \Wikichua\Dashing\Models\User
```

```php
    protected $casts = [
        'social' => 'array',
    ];
```

Run in your bash

```bash
php artisan migrate
npm run dev
```

In your browser

Access to your https://***YourProject***.test/admin.
Email : admin@email.com
Password : admin123

[ico-version]: https://img.shields.io/packagist/v/wikichua/dashing.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wikichua/dashing.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/wikichua/dashing/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/wikichua/dashing
[link-downloads]: https://packagist.org/packages/wikichua/dashing
[link-travis]: https://travis-ci.org/wikichua/dashing
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/wikichua
[link-contributors]: ../../contributors
