<?php

namespace farazasifali\Larapress;

use Illuminate\Support\Facades\File;

class FileParser
{
    protected $filename;
    protected $data;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->generateParts();
        $this->explodeParts();
    }

    protected function generateParts()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
            File::get($this->filename),
            $this->data
        );
    }

    protected function explodeParts()
    {
        dd(explode("\n", trim($this->data[1])));
    }

    public function getData()
    {
        return $this->data;
    }
}
