<?php

namespace Wikichua\Dashing\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Install extends Command
{
    protected $signature = 'dashing:install {--no-compiled}';

    protected $description = 'Dashing Installation';

    public function __construct()
    {
        parent::__construct();

        $this->vendorPath = base_path('vendor/wikichua/dashing');
        if (is_dir(base_path('packages/Wikichua/Dashing'))) {
            $this->vendorPath = base_path('packages/Wikichua/Dashing');
        } elseif (is_dir(base_path('packages/wikichua/dashing'))) {
            $this->vendorPath = base_path('packages/wikichua/dashing');
        }
    }

    public function handle()
    {
        $vendorPath = $this->vendorPath;

        File::ensureDirectoryExists(resource_path('views/vendor/dashing/components'));
        $files = [
            $vendorPath.'/package.json' => base_path('package.json'),
            $vendorPath.'/webpack.mix.js' => base_path('webpack.mix.js'),
            $vendorPath.'/resources/css' => resource_path('css'),
            $vendorPath.'/resources/scss' => resource_path('scss'),
            $vendorPath.'/resources/js' => resource_path('js'),
        ];
        $this->copiesFileOrDirectory($files);
        $this->copiesFileOrDirectory([
            $vendorPath.'/resources/views/components/custom-admin-menu.blade.php' => resource_path('views/vendor/dashing/components/custom-admin-menu.blade.php'),
        ], false);
        $this->checkCacheDriver();
        $this->replaceRouteServiceProviderHomeConst();
        $this->replaceUserModelExtends();
        $this->injectRunCronjobsCallIntoConsoleKernel();
        $this->injectUseArtisanTraitIntoConsoleKernel();
        $this->injectDisableCommandsCallConsoleKernel();
        $this->injectLogCacheKeyInEventListener();
        $this->injectMixAppNameInEnvFile();
        $this->removeDefaultWebRoute();
        if ($this->option('no-compiled') != true) {
            $this->dumpComposer();
            if ($this->confirm('npm install?', true)) {
                $output = shell_exec('npm install');
                $this->info($output);
            }
            if ($this->confirm('npm run prod?', true)) {
                $output = shell_exec('npm run prod');
                $this->info($output);
            }
        }
        cache()->flush();
        return ;
    }
    protected function dumpComposer()
    {
        $output = shell_exec('composer dump');
        $this->info($output);
    }

    protected function checkCacheDriver()
    {
        if (in_array(config('cache.default'), ['file'])) {
            $file = config_path('cache.php');
            $content = @File::get($file);
            if (!str_contains($content, '\'default\' => env(\'CACHE_DRIVER\', \'array\'),')) {
                $lines = explode(PHP_EOL, $content);
                foreach ($lines as $key => $line) {
                    if (str_contains($line, '\'default\' => env(\'CACHE_DRIVER\', \'file\'),')) {
                        $from = $line;
                        $to = $lines[$key] = str_repeat("\t", 1).'\'default\' => env(\'CACHE_DRIVER\', \'array\'),';
                    }
                }
                if (isset($from)) {
                    @File::replace($file, implode(PHP_EOL, $lines));
                    $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                    $this->newLine();
                }
            }
        }
        $file = base_path('.env');
        $content = @File::get($file);
        if (str_contains($content, 'CACHE_DRIVER=file')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, 'CACHE_DRIVER=file')) {
                    $from = $line;
                    $to = $lines[$key] = 'CACHE_DRIVER=array';
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }

    protected function copiesFileOrDirectory(array $data, $replace = true)
    {
        foreach ($data as $from => $to) {
            if ($replace == false && file_exists($to)) {
                return;
            }
            is_dir($from)? @File::copyDirectory($from, $to):@File::copy($from, $to);
            $this->info('Copy '.$from.' to '. $to);
            $this->newLine();
        }
    }

    protected function replaceRouteServiceProviderHomeConst()
    {
        $file = app_path('Providers/RouteServiceProvider.php');
        $lines = explode(PHP_EOL, @File::get($file));
        foreach ($lines as $key => $line) {
            if (str_contains($line, 'public const HOME')) {
                $from = $line;
                $to = $lines[$key] = "\tpublic const HOME = '/';";
            }
        }
        if (isset($from) && '' != $from) {
            @File::replace($file, implode(PHP_EOL, $lines));
            $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
            $this->newLine();
        }
    }

    protected function replaceUserModelExtends()
    {
        $file = app_path('Models/User.php');
        $content = @File::get($file);
        if (!str_contains($content, 'class User extends \Wikichua\Dashing\Models\User')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, 'class User extends Authenticatable')) {
                    $from = $line;
                    $to = $lines[$key] = 'class User extends \Wikichua\Dashing\Models\User';
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }

    protected function injectRunCronjobsCallIntoConsoleKernel()
    {
        $file = app_path('Console/Kernel.php');
        $content = @File::get($file);
        if (!str_contains($content, '$this->runCronjobs($schedule);')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, '$schedule->command(\'inspire\')->hourly();')) {
                    $from = $line;
                    $to = $lines[$key] = $line.PHP_EOL.str_repeat("\t", 2).'$this->runCronjobs($schedule);';
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }

    protected function injectUseArtisanTraitIntoConsoleKernel()
    {
        $file = app_path('Console/Kernel.php');
        $content = @File::get($file);
        if (!str_contains($content, 'use \Wikichua\Dashing\Http\Traits\ArtisanTrait;')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, 'protected $commands')) {
                    $from = $line;
                    $to = $lines[$key] = str_repeat("\t", 1).'use \Wikichua\Dashing\Http\Traits\ArtisanTrait;'.PHP_EOL.str_repeat("\t", 1).'protected $commands_disabled = [
        \'production\' => [\'migrate:fresh\',\'migrate:refresh\',\'migrate:reset\',\'dashing:install\'],
    ];'.PHP_EOL.$line;
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }

    protected function injectDisableCommandsCallConsoleKernel()
    {
        $file = app_path('Console/Kernel.php');
        $content = @File::get($file);
        if (!str_contains($content, '$this->disableCommands();')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, '$this->load(__DIR__.\'/Commands\');')) {
                    $from = $line;
                    $to = $lines[$key] = str_repeat("\t", 2).'$this->disableCommands();'.PHP_EOL.$line;
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }
    protected function injectLogCacheKeyInEventListener()
    {
        $file = app_path('Providers/EventServiceProvider.php');
        $content = @File::get($file);
        if (!str_contains($content, 'Wikichua\Dashing\Listeners\LogKeyWritten')) {
            $lines = explode(PHP_EOL, $content);
            foreach ($lines as $key => $line) {
                if (str_contains($line, 'protected $listen = [')) {
                    $from = $line;
                    $to = $lines[$key] = $line.PHP_EOL.str_repeat("\t", 2).'\'Illuminate\Cache\Events\KeyWritten\' => [
            \'Wikichua\Dashing\Listeners\LogKeyWritten\',
        ],
        \'Illuminate\Cache\Events\KeyForgotten\' => [
            \'Wikichua\\Dashing\\Listeners\\LogKeyForgotten\',
        ],';
                }
            }
            if (isset($from)) {
                @File::replace($file, implode(PHP_EOL, $lines));
                $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                $this->newLine();
            }
        }
    }
    protected function injectMixAppNameInEnvFile()
    {
        $files = [base_path('.env.example'), base_path('.env')];
        foreach ($files as $file) {
            $content = @File::get($file);
            if (!str_contains($content, 'MIX_APP_KEY')) {
                $lines = explode(PHP_EOL, $content);
                foreach ($lines as $key => $line) {
                    if (str_contains($line, 'APP_DEBUG')) {
                        $from = $line;
                        $to = $lines[$key] = 'MIX_APP_KEY="${APP_KEY}"'.PHP_EOL.$line;
                    }
                }
                if (isset($from)) {
                    @File::replace($file, implode(PHP_EOL, $lines));
                    $this->info('Replace '.trim($from).' to '. trim($to) . ' in ' . $file);
                    $this->newLine();
                }
            }
        }
    }
    protected function removeDefaultWebRoute()
    {
        $file = base_path('routes/web.php');
        $content = @File::get($file);
        $lines = explode(PHP_EOL, $content);
        foreach ($lines as $key => $line) {
            if (Str::contains($line, 'Route::get(\'/\', function () {')) {
                $string = $lines[$key].PHP_EOL.$lines[$key + 1].PHP_EOL.$lines[$key + 2];
                unset($lines[$key], $lines[$key + 1], $lines[$key + 2]);
            }
        }
        if (isset($string)) {
            @File::replace($file, implode(PHP_EOL, $lines));
            $this->info('Removed '.$string);
            $this->newLine();
        }
    }
}
