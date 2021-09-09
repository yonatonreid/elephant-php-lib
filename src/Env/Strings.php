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

    public static function mbStrtolower(string $str, string $encoding = null)
    {
        return mb_strtolower($str, static ::mbInternalEncoding($encoding));
    }

    public static function mbInternalEncoding(string $encoding = null)
    {
        if (is_null($encoding)) {
            return mb_internal_encoding();
        }
        return mb_internal_encoding($encoding);
    }

    public static function ucWords($str,$destSep='_',$srcSep='_'){
        return str_replace(' ', $destSep, ucwords(str_replace($srcSep, ' ', $str)));
    }
}