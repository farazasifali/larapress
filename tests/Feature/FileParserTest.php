<?php


namespace farazasifali\Blog\Tests\Feature;

use farazasifali\Blog\FileParser;
use Orchestra\Testbench\TestCase;

class FileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $fileParser = (new FileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $fileParser->getData();

        $this->assertContains("title: Post Title", $data[0]);
        $this->assertContains("description: Description here", $data[1]);
        $this->assertContains("Blog post body here", $data[2]);
    }
}
