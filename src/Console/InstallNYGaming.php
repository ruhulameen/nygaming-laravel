<?php

namespace Ruhul\NYGaming\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallNYGaming extends Command
{
    protected $signature = 'nygaming:install';

    protected $description = 'Install the NYGaming laravel package';

    public function handle()
    {
        $this->info('Installing NYGaming Laravel Package...');

        $this->info('Publishing configuration...');

        if (!$this->configExists('newyorkgaming.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed NYGaming Laravel Package');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Ruhul\NYGaming\NewYorkGamingServiceProvider",
            '--tag' => "nyg-config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
