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
}