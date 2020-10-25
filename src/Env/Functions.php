<?php

declare(strict_types=1);

namespace Elephant\Env;

use function call_user_func_array;

class Functions
{
    public static function callUserFuncArray(callable $callback, array $paramArr)
    {
        return call_user_func_array($callback, $paramArr);
    }

    public static function isArray($value): bool
    {
        return is_array($value);
    }

    public static function count(array $array): int
    {
        return count($array);
    }

    public static function empty($val)
    {
        return empty($val);
    }

}