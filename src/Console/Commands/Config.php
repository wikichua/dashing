<?php

 namespace Wikichua\Dashing\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Config extends Command
{
    protected $signature = 'dashing:config:module {model} {--brand=}';
    protected $description = 'Generate Config File Into Config Directory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Filesystem $files)
    {
        $this->brand = $this->option('brand') ? $this->option('brand') : null;

        if ($this->brand) {
            $brand = app(config('dashing.Models.Brand'))->query()->where('name', strtolower($this->brand))->first();
            if (!$brand) {
                $this->error('Brand not found: <info>'.$this->brand.'</info>');

                return '';
            }
            $config_path = base_path('brand/'.$this->brand.'/resources/config/dashing');
            $model = $this->brand.(str_replace($this->brand, '', $this->argument('model')));
        } else {
            $config_path = resource_path('config/dashing');
            $model = $this->argument('model');
        }

        $files->ensureDirectoryExists($config_path);
        $config_stub = config('dashing.stubs.path').'/config.stub';
        if (!$files->exists($config_stub)) {
            $config_stub = __DIR__.'/../../resources/stubs/config.stub';
        }
        $config_file = $config_path.'/'.$model.'Config.php';
        $files->copy($config_stub, $config_file);
        $this->line('Config file created: <info>'.$config_file.'</info>');
        cache()->flush();
    }
}
