<?php

namespace Farazasifali\Blog\Tests\Unit;

use Farazasifali\Blog\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallBlogTest extends TestCase
{
    /** @test */
    function this_install_command_copies_the_configuration()
    {
        $file = config_path('blog.php');

        if(File::exists($file))
        {
            unlink(config_path('blog.php'));
        }

        $this->assertFalse(File::exists($file));

        Artisan::call('blog:install');

        $this->assertTrue(File::exists($file));
    }

    /** @test */
    public function when_a_config_file_is_present_users_can_choose_to_not_overwrite_it()
    {
        $file = config_path('blog.php');

        // Given we have already have an existing config file
        File::put($file, 'test contents');
        $this->assertTrue(File::exists($file));

        // When we run the install command
        $command = $this->artisan('blog:install');

        // We expect a warning that our configuration file exists
        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "no"
            'no'
        );

        // We should see a message that our file was not overwritten
        $command->expectsOutput('Existing configuration was not overwritten.');

        // Assert that the original contents of the config file remain
        $this->assertEquals('test contents', file_get_contents($file));

        // Clean up
        unlink($file);
    }

    /** @test */
    public function when_a_config_file_is_present_users_can_choose_to_do_overwrite_it()
    {
        $file = config_path('blog.php');

        // Given we have already have an existing config file
        File::put($file, 'test contents');
        $this->assertTrue(File::exists($file));

        // When we run the install command
        $command = $this->artisan('blog:install');

        // We expect a warning that our configuration file exists
        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "yes"
            'yes'
        );

        // execute the command to force override
        $command->execute();

        $command->expectsOutput('Overwriting configuration file...');

        // Assert that the original contents are overwritten
        $this->assertEquals(
            file_get_contents($file),
            file_get_contents($file)
        );

        // Clean up
        unlink($file);
    }
}
