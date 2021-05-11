## Installation

### Add Dashing Access Token

```bash
composer config github-oauth.github.com <github-personal-access-token>
```

OR

```bash
composer config http-basic.github.com wikichua <github-personal-access-token>
```

Note: for now, not sure why when commit push auth.json to git, the PAT set will disappear

### Add Repositories in your composer.json

Add this into your composer.json

```json
    "repositories": {
        "wikichua/iap": {
            "type": "vcs",
            "url": "https://github.com/wikichua/IAP.git"
        }
    }
```

Run in your bash

```bash
mysql -uhomestead -p <<_EOF_
CREATE DATABASE *YourDatabase*;
_EOF_
laravel new *YourProject*
composer require laravel/ui
```

Ammend your .env

```env
APP_URL=https://*yourproject.test*
DB_DATABASE=*YourDatabase*
```

Run in your bash

```bash
composer require wikichua/dashing:dev-master
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
