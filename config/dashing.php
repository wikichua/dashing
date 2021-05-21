<?php

return [
    'broadcast' => [
        'driver' => '', // pusher or ably or ''
    ],
    'route' => [
        'root' => '/admin', // if empty please add /
    ],
    'stubs' => [
        'path' => 'vendor/wikichua/dashing/stubs',
    ],
    'audit' => [
        'masks' => [ // masking the key in data field within the activity log model
            'password',
            'password_confirmation',
            'token',
        ],
    ],
    'reauth' => [
        'timeout' => 600, // default 10 mins
        'reset' => true,
    ],
    'Controllers' => [
        'Auth' => [
            'AuthenticatedSession' => \Wikichua\Dashing\Http\Controllers\Auth\AuthenticatedSessionController::class,
            'ConfirmablePassword' => \Wikichua\Dashing\Http\Controllers\Auth\ConfirmablePasswordController::class,
            'EmailVerificationNotification' => \Wikichua\Dashing\Http\Controllers\Auth\EmailVerificationNotificationController::class,
            'EmailVerificationPrompt' => \Wikichua\Dashing\Http\Controllers\Auth\EmailVerificationPromptController::class,
            'NewPassword' => \Wikichua\Dashing\Http\Controllers\Auth\NewPasswordController::class,
            'PasswordResetLink' => \Wikichua\Dashing\Http\Controllers\Auth\PasswordResetLinkController::class,
            'RegisteredUser' => \Wikichua\Dashing\Http\Controllers\Auth\RegisteredUserController::class,
            'VerifyEmail' => \Wikichua\Dashing\Http\Controllers\Auth\VerifyEmailController::class,
            'Reauth' => \Wikichua\Dashing\Http\Controllers\Auth\ReauthController::class,
        ],
        'Cache' => \Wikichua\Dashing\Http\Controllers\Admin\CacheController::class,
        'Profile' => \Wikichua\Dashing\Http\Controllers\Admin\ProfileController::class,
        'Dashboard' => \Wikichua\Dashing\Http\Controllers\Admin\DashboardController::class,
        'User' => \Wikichua\Dashing\Http\Controllers\Admin\UserController::class,
        'PAT' => \Wikichua\Dashing\Http\Controllers\Admin\UserPersonalAccessTokenController::class,
        'Permission' => \Wikichua\Dashing\Http\Controllers\Admin\PermissionController::class,
        'Role' => \Wikichua\Dashing\Http\Controllers\Admin\RoleController::class,
        'Setting' => \Wikichua\Dashing\Http\Controllers\Admin\SettingController::class,
        'Audit' => \Wikichua\Dashing\Http\Controllers\Admin\AuditController::class,
        'Report' => \Wikichua\Dashing\Http\Controllers\Admin\ReportController::class,
        'GlobalSearch' => \Wikichua\Dashing\Http\Controllers\Admin\GlobalSearchController::class,
        'Cronjob' => \Wikichua\Dashing\Http\Controllers\Admin\CronjobController::class,
        'LogViewer' => \Wikichua\Dashing\Http\Controllers\Admin\LogViewerController::class,
        'Mailer' => \Wikichua\Dashing\Http\Controllers\Admin\MailerController::class,
        'Versionizer' => \Wikichua\Dashing\Http\Controllers\Admin\VersionizerController::class,
        'FailedJob' => \Wikichua\Dashing\Http\Controllers\Admin\FailedJobController::class,
        'Brand' => \Wikichua\Dashing\Http\Controllers\Admin\BrandController::class,
        'Page' => \Wikichua\Dashing\Http\Controllers\Admin\PageController::class,
        'Component' => \Wikichua\Dashing\Http\Controllers\Admin\ComponentController::class,
        'File' => \Wikichua\Dashing\Http\Controllers\Admin\FileController::class,
        'Nav' => \Wikichua\Dashing\Http\Controllers\Admin\NavController::class,
        'Pusher' => \Wikichua\Dashing\Http\Controllers\Admin\PusherController::class,
        'Carousel' => \Wikichua\Dashing\Http\Controllers\Admin\CarouselController::class,
    ],
    'Models' => [
        'User' => \App\Models\User::class,
        'Versionizer' => \Wikichua\Dashing\Models\Versionizer::class,
        'Searchable' => \Wikichua\Dashing\Models\Searchable::class,
        'Role' => \Wikichua\Dashing\Models\Role::class,
        'Permission' => \Wikichua\Dashing\Models\Permission::class,
        'Setting' => \Wikichua\Dashing\Models\Setting::class,
        'Report' => \Wikichua\Dashing\Models\Report::class,
        'Audit' => \Wikichua\Dashing\Models\Audit::class,
        'FailedJob' => \Wikichua\Dashing\Models\FailedJob::class,
        'Brand' => \Wikichua\Dashing\Models\Brand::class,
        'Page' => \Wikichua\Dashing\Models\Page::class,
        'Nav' => \Wikichua\Dashing\Models\Nav::class,
        'Component' => \Wikichua\Dashing\Models\Component::class,
        'Carousel' => \Wikichua\Dashing\Models\Carousel::class,
        'Cronjob' => \Wikichua\Dashing\Models\Cronjob::class,
        'Mailer' => \Wikichua\Dashing\Models\Mailer::class,
        'Pusher' => \Wikichua\Dashing\Models\Pusher::class,
        'Alert' => \Wikichua\Dashing\Models\Alert::class,
    ],
];
