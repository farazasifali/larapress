<?php

namespace farazasifali\blog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBlog extends Command
{
    protected $signature = 'blog:install';

    protected $description = 'Install the blog';

    /**
     * Laravel default invoking method
     * to handle command execution
     *
     * @return void
     */
    public function handle()
    {
        //Displaying info in console
        $this->info('Installing blog...');
        $this->info('Publishing configuration...');
        //Check if file is already exist
        if($this->configExists('blog.php'))
        {
            $this->handleConfigOverwrite();
        }
        else
        {
            $this->publishConfiguration();
        }
        //Installed message in console
        $this->info('Blog installed!');
    }

    /**
     * Method to check if config file
     * already exists in system
     *
     * @param $filename
     * @return bool
     */
    private function configExists($filename)
    {
        return File::exists(config_path($filename));
    }

    /**
     * Method confirm config overwrite
     *
     * @return bool
     */
    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    /**
     * Method to handle config file overwrite
     *
     */
    private function handleConfigOverwrite()
    {
        if($this->shouldOverwriteConfig())
        {
            $this->info('Overwriting configuration file...');
            $this->publishConfiguration($force = true);
        }
        else
        {
            $this->info('Existing configuration was not overwritten.');
        }
    }

    /**
     * Method to publish config file
     *
     * @param  false  $forced
     */
    private function publishConfiguration($forced = false)
    {
        $params = [
            '--provider' => "Farazasifali\Blog\BlogServiceProvider",
            '--tag' => "config"
        ];

        if($forced)
        {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
