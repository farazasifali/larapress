<?php

namespace Farazasifali\Blog\Tests;

use Farazasifali\Blog\BlogServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Method to
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BlogServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
