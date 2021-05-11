## Module Development

- [Create New Module with Dashing](#Create-New-Module-with-Dashing)
- [Create New Service](#Create-New-Service)
- [Create Service which belongs to Brand Only](#Create-Service-which-belongs-to-Brand-Only)
- [Create Export and Import Module with Dashing](#Create-Export-and-Import-Module-with-Dashing)
- [Create New Brand with Dashing](#Create-New-Brand-with-Dashing)
- [Create New Component with Dashing](#Create-New-Component-with-Dashing)
- [Create Component which belongs to Brand Only](#Create-Component-which-belongs-to-Brand-Only)
- [Using Pusher in your application](#Using-Pusher-in-your-application)
- [Run Indexing Data Into Global Searchable](#Run-Indexing-Data-Into-Global-Searchable)
- [Run Report with Artisan and Task Scheduler](#Run-Report-with-Artisan-and-Task-Scheduler)
- [Queue and Cache Closure](#Queue-and-Cache-Closure)
- [PHP Debug Bar](#PHP-Debug-Bar)
- [Enable Cronjob Admin](#Enable-Cronjob-Admin)
- [Disable Artisan Command](#Disable-Artisan-Command)
- [Social Lite](#Social-Lite)
- [Model Events](#Model-Events)
- [Create Mailer with Dashing](#Create-Mailer-with-Dashing)
- [Running Pusher Scheduling](#Running-Pusher-Scheduling)
- [Reauthenticating Activity](#Reauthenticating-Activity)

### <a name="Create-New-Module-with-Dashing"></a>Create New Module with Dashing

**ModuleName** - MUST be Plural + Studly Case

#### <a name="Create-Config"></a>Create Config

Run in your bash

```bash
php artsan dashing:config:module *ModuleName*
```

Or for Brand

```bash
php artsan dashing:config:module *ModuleName* --Brand=*BrandName*
```

[Config Sample](../stubs/config.stub)
Add or remove any configuration that doesn't need and set *ready* to *true*

#### <a name="Make-Module"></a>Make Module

Run in your bash

```bash
php artsan dashing:make:module *ModuleName*
```

Or for Brand

```bash
php artsan dashing:make:module *ModuleName* --Brand=*BrandName*
```

### <a name="Create-New-Service"></a>Create New Service

**ServiceName** - MUST be Plural + Studly Case

Run in your bash

```bash
php artisan dashing:make:service *ServiceName*
```

### <a name="Create-Service-which-belongs-to-Brand-Only"></a>Create Service which belongs to Brand Only

Run in your bash

```bash
php artisan dashing:make:service *ServiceName* --brand=*BrandName*
```

You may like to add your business model as a service.

#### <a name="Create-Export-and-Import-Module-with-Dashing"></a>Create Export and Import Module with Dashing

#### <a name="Export-Module"></a>Export Module

Run in your bash

```bash
php artisan dashing:export *ModuleName*
```

Export Brand Module

```bash
php artisan dashing:export *ModuleName* --brand=*BrandName*
```

Export to your preferred path

```bash
php artisan dashing:export *ModuleName* "~/Desktop" --brand=*BrandName*
```

#### <a name="Import-Module"></a>Import Module

Run in your bash

```bash
php artisan dashing:import */path/to/your/zip/file/location/module.zip*
```

Import Brand Module

```bash
php artisan dashing:import */path/to/your/zip/file/location/module.zip* --brand=*BrandName*
```

Note: Brand's Module is transferable to another Brand.
Meaning that, You can export a module from Brand A, and import it back to Brand B by specifiying *--brand=BrandB*

#### <a name="Using-Pusher-in-your-application"></a>Using Pusher in your application

With Helper should be much more easy.

```php
    pushered('hello string');
    pushered(['hello array','hello array again']);
    pushered(['message' => 'hello message']);
    pushered([
        'title' => 'hello title',
        'message' => 'hello message',
        'icon' => asset('your/logo'),
        'link' => 'http://link.com',
        'timeout' => 5000,
    ]);
```

By default, this will pushed to "general" event on your default app channel.

- **message** key is important as to show on the web push notification. If there is no message key defined, array of the param will be imploded to string and assigned to message key.

### <a name="Create-New-Brand-with-Dashing"></a>Create New Brand with Dashing

**BrandName** - MUST be Plural + Studly Case

Run in your bash

```bash
php artisan dashing:make:brand *BrandName* --domain=*domain.test*
```

This brand will be scaffolded with the set of

1. Seeder for sample page, sample navigation, sample carousel and login modal (social lite)
2. Domain aliases (file domains.php) - *Need to clear cache for this*
3. Template using MDB (https://mdbootstrap.com)
4. Sample Page
5. Login Modal Component (include social lite for register)
```html
<x-{%brand_string%}::login-modal />
```
6. Top Navbar Login Component
```html
<x-{%brand_string%}::navbar-top-login />
```
7. Top Navbar Component
```html
<x-{%brand_string%}::navbar-top groupSlug="sample-navbar" />
```
8. Carousel Component
```html
<x-{%brand_string%}::carousel slug="sample-carousel" :tags="['new','hot']" />
```

More about [Brand Development](Brand-Development.md)

### <a name="Create-New-Component-with-Dashing"></a>Create New Component with Dashing

Run in your bash

```bash
php artisan dashing:make:component *ComponentName*
```

### <a name="Create-Component-which-belongs-to-Brand-Only"></a>Create Component which belongs to Brand Only

Run in your bash

```bash
php artisan dashing:make:component *ComponentName* --brand=*BrandName*
```

### <a name="Run-Indexing-Data-Into-Global-Searchable"></a>Run Indexing Data Into Global Searchable

Run in your bash

```bash
php artisan dashing:run:indexing
```

### <a name="Run-Report-with-Artisan-and-Task-Scheduler"></a>Run Report with Artisan and Task Scheduler

```bash
php artisan dashing:run:report
```

Specific report only

```bash
php artisan dashing:run:report *name*
```

Work / Run with queue / sync

```bash
php artisan dashing:run:report --method=queue
php artisan dashing:run:report --method=sync
```

Please read about [Laravel Task Scheduling](https://laravel.com/docs/8.x/scheduling#starting-the-scheduler)

```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('dashing:run:report', [
        '--method' => 'queue', // sync
    ])->withoutOverlapping()->runInBackground()->hourly();
}
```

Please read about [Laravel Supervisor Configuration](https://laravel.com/docs/8.x/queues#supervisor-configuration)

```bash
php artisan queue:work --tries=3 --backoff=3 --queue=report_processing
```

### <a name="Queue-and-Cache-Closure"></a>Queue and Cache Closure

#### <a name="Queue"></a>Queue

```php
dispatch(function () use ($mail) {
    $mail->send();
})->onQueue('high');
```

```bash
php artisan queue:work --queue=high,low
```

#### <a name="Cache"></a>Cache

```php
// set cache
cache(['key' => 'value'], $seconds);
cache(['key' => 'value'], now()->addSeconds(10));
// get cache
$value = cache('key');
// get cache, if no set return default
$value = cache('key', 'default');
// remove cache
cache()->forget('key');
// flush all caches
cache()->flush();
// closure with ttl
$users = cache()->remember('users', $seconds, function () {
    return DB::table('users')->get();
});
// closure without ttl and never expired
$users = cache()->rememberForever('users', function () {
    return DB::table('users')->get();
});
```

### <a name="PHP-Debug-Bar"></a>PHP Debug Bar

This feature is automatic enable in non production environment
However, you will need to exclude it in api related routes

At your debugbar.php

```php
    'except' => [
        'telescope*',
        'horizon*',
        'api*',
    ],
```

### <a name="Enable-Cronjob-Admin"></a>Enable Cronjob Admin

In your app/Console/Kernel.php

```php
class Kernel extends ConsoleKernel
{
    use \Wikichua\Dashing\Http\Traits\ArtisanTrait;
    protected function schedule(Schedule $schedule)
    {
        $this->runCronjobs($schedule);
    }
```

### <a name="Disable-Artisan-Command"></a>Disable Artisan Command

In your app/Console/Kernel.php

```php
class Kernel extends ConsoleKernel
{
    use \Wikichua\Dashing\Http\Traits\ArtisanTrait;
    protected $commands_disabled = [
        'production' => ['migrate:fresh','migrate:refresh','migrate:reset','dashing:install'],
    ];
    protected function commands()
    {
        $this->disableCommands();
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
```

Notes: 1st argument takes array for the command to be disabled while the 2nd argument is an array for environment that you want it to be run on.

### <a name="Social-Lite"></a>Social Lite

In your User.php model

```php
protected $casts = [
    'social' => 'array',
];
```

Then in your .env

```dotenv
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=

LINKEDIN_CLIENT_ID=
LINKEDIN_CLIENT_SECRET=

TWITTER_CLIENT_ID=
TWITTER_CLIENT_SECRET=

```

Access to your https://***YourProject***.test/pub.
You should see another login page which mainly for public access instead of admin.
You should be seeing login with social media icons appearing based on the those credential filled for your provider.

As for your brand social lite login, you should hardcoded in the brand/**BrandName**/config/services.php

### <a name="Model-Events"></a>Model Events

May refer to [Laravel Event](https://laravel.com/docs/8.x/eloquent#events).
Due to *Saved* and *Deleted* has been used as static called, in case of need to have additional events runs on those events mentioned. Please do use as stated below.

- onCreatedEvent
- onUpdatedEvent
- onDeletedEvent
- onCachedEvent

*onCachedEvent* basically will executed in *Saved* and *Deleted* events.
In your **model**.php

```php
    public function onCachedEvent()
    {
        cache()->forget('your-cache-name');
    }
```

*onCreatedEvent*, *onUpdatedEvent*, *onDeletedEvent*, *onCachedEvent*, these events will not be execute if there is no defined method in your model php.

### <a name="Create-Mailer-with-Dashing"></a>Create Mailer with Dashing

Run in your bash

```bash
php artisan dashing:make:mailer *MailName*
```

For specific brand

Run in your bash

```bash
php artisan dashing:make:mailer *MailName* --brand=*BrandName*
```

Run migrate to seed the mailer record

To send or queue email please refer to (Laravel Mail)[https://laravel.com/docs/8.x/mail#sending-mail]

### <a name="Running-Pusher-Scheduling"></a>Running Pusher Scheduling

Run in your bash for platform

```bash
php artisan dashing:run:pusher
```

For specific brand

Run in your bash

```bash
php artisan dashing:run:pusher --brand=*BrandName*
```

You could put this within the cronjob management as well.

### <a name="Reauthenticating-Activity"></a>Reauthenticating Activity

In your **Module**Controller.php at contructor, add this as middleware layer to check if right user is still valid.

Validity last for 10 mins after reauthenticated

```php
$this->middleware('reauth_admin')->only(['edit','destroy']);
```
