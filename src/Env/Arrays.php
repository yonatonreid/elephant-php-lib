<?php

declare(strict_types=1);

namespace Elephant\Env;

use function array_change_key_case;
use function array_chunk;
use function array_column;
use function array_combine;
use function array_count_values;

class Arrays
{
    public static function arrayChangeKeyCase(array $array, int $case = CASE_LOWER): array
    {
        return array_change_key_case($array, $case);
    }

    public static function arrayChangeKeyCaseRecursive(array $array,int $case=CASE_LOWER):array{
        return array_map(function($item,$case){
            if(is_array($item)){
                $item = static::arrayChangeKeyCaseRecursive($item,$case);
            }
            return $item;
        },static::arrayChangeKeyCase($array,$case));
    }

    public static function arrayChangeKeyCaseUnicode(array $array,int $case=CASE_LOWER):array{
        $case = ($case == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
        $ret=[];
        foreach($array as $k => $v){
            $ret[Strings::mbConvertCase($k,$case,"UTF-8")] = $v;
        }
        return $ret;
    }

    public static function arrayChangeKeyRecursiveUnicode(array $array,int $case=CASE_LOWER):array{
        return array_map(function($item,$case){
            if(is_array($item)){
                $item = static::arrayChangeKeyRecursiveUnicode($item,$case);
            }
            return $item;
        },static::arrayChangeKeyCaseUnicode($array,$case));
    }

    public static function arrayChunk(array $array, int $size, bool $preserveKeys = false): array
    {
        return array_chunk($array, $size, $preserveKeys);
    }

    public static function arrayColumn(array $input, $columnKey, $indexKey = null): array
    {
        return array_column($input, $columnKey, $indexKey);
    }

    public static function arrayCombine(array $keys, array $values): array
    {
        return array_combine($keys, $values);
    }

    public static function arrayCountValues(array $array): array
    {
        return array_count_values($array);
    }

    public static function arrayDiffAssoc(): array
    {
        return Functions ::callUserFuncArray('array_diff_assoc', func_get_args());
    }

    public static function arrayDiffKey(): array
    {
        return Functions ::callUserFuncArray('array_diff_key', func_get_args());
    }

    public static function arrayDiffUassoc(): array
    {
        return Functions ::callUserFuncArray('array_diff_uassoc', func_get_args());
    }

    public static function arrayDiffUkey(): array
    {
        return Functions ::callUserFuncArray('array_diff_ukey', func_get_args());
    }

    public static function arrayDiff(): array
    {
        return Functions ::callUserFuncArray('array_diff', func_get_args());
    }
}