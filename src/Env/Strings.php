<?php

declare(strict_types=1);

namespace Elephant\Env;

use function mb_convert_case;

class Strings
{
    public static function mbConvertCase(string $str, int $mode, string $encoding = "UTF-8")
    {
        return mb_convert_case($str, $mode, $encoding);
    }
}