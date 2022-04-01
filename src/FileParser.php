<?php

namespace farazasifali\Blog;

use Illuminate\Support\Facades\File;

class FileParser
{
    protected $filename;
    protected $data;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->generateParts();
    }

    public function generateParts()
    {
        preg_match_all('/^\-{3}(.*?)\-{3}(.*)/s',
            File::get($this->filename),
            $this->data
        );

        dd($this->data);
    }

    public function getData()
    {
        return $this->data;
    }
}
