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

    public static function isScalar($val){
        return is_scalar($val);
    }

    public static function isNull($val){
        return is_null($val);
    }

    public static function isObject($obj){
        return is_object($obj);
    }

    public static function destroyObject($object){
        if (is_array($object)) {
            foreach ($object as $obj) {
                static::destroyObject($obj);
            }
        } else {
            $object -> __destruct();
            unset($object);
        }
    }
}