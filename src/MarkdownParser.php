<?php

namespace farazasifali\Larapress;

use Parsedown;

class MarkdownParser
{
    public static function parse($string)
    {
        return Parsedown::instance()->text($string);
    }
}
