<?php


namespace farazasifali\Larapress\Tests\Feature;

use farazasifali\Larapress\FileParser;
use Orchestra\Testbench\TestCase;

class FileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $fileParser = (new FileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $fileParser->getData();

        $this->assertStringContainsString("title: Post Title", $data[1]);
        $this->assertStringContainsString("description: Description here", $data[1]);
        $this->assertStringContainsString("Blog post body here", $data[2]);
    }

    /** @test */
    public function each_head_field_get_separated()
    {
        $fileParser = (new FileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $fileParser->getData();

        $this->assertEquals('Post Title', $data['title']);
        $this->assertEquals('Description here', $data['description']);
    }
}
