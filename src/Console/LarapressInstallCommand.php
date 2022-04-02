<?php

namespace farazasifali\Larapress\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LarapressInstallCommand extends Command
{
    protected $signature = "larapress:install";

    protected $description = "To install larapress";

    private $forcedOverwrite = false;

    public function handle()
    {
        $this->info("Installing Larapress");

        if($this->configFileExists())
        {
            $this->forcedOverwrite = $this->shouldForceInstall();
        }

        $this->publishConfig();

        $this->info("Larapress installed");
    }

    /**
     * Method to check config file exists
     *
     * @return bool
     */
    private function configFileExists()
    {
        return File::exists(config_path('larapress.php'));
    }

    /**
     * Method to get the permission for overwrite
     *
     * @return bool
     */
    private function shouldForceInstall()
    {
        $answer = $this->confirm(
            "Its seems that your application have some files conflicts. Do you want us to overwrite files?",
            false
        );

        if($answer)
            $this->info("Overwriting project files");

        return $answer;
    }

    private function publishConfig()
    {
        $params = [
            "--provider" => 'farazasifali\Larapress\LarapressBaseServiceProvider',
            "--tag" => 'config'
        ];

        if($this->forcedOverwrite)
        {
            $params['--force'] = true;
        }

        $this->call("vendor:publish", $params);
    }

}
