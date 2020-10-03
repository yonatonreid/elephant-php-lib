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

    public static function arrayChangeKeyCaseRecursive(array $array, int $case = CASE_LOWER): array
    {
        return array_map(function ($item) use ($case) {
            if (is_array($item))
                $item = static ::arrayChangeKeyCaseRecursive($item, $case);
            return $item;
        }, static ::arrayChangeKeyCase($array, $case));
    }

    public static function arrayChangeKeyCaseUnicode(array $array, int $case = MB_CASE_LOWER, string $encoding = "UTF-8"): array
    {
        $ret = [];
        foreach ($array as $k => $v) {
            $ret[Strings ::mbConvertCase($k, $case, $encoding)] = $v;
        }
        return $ret;
    }

    public static function arrayChangeKeyUnicodeRecursive(array $array, int $case = MB_CASE_LOWER): array
    {
        return array_map(function ($item) use ($case) {
            if (is_array($item))
                $item = static ::arrayChangeKeyUnicodeRecursive($item, $case);
            return $item;
        }, static ::arrayChangeKeyCaseUnicode($array, $case));
    }

    public static function arrayChunk(array $array, int $size, bool $preserveKeys = false): array
    {
        return array_chunk($array, $size, $preserveKeys);
    }

    public static function arrayUnChunk(array $array)
    {
        return Functions ::callUserFuncArray([Arrays::class, 'arrayMerge'], $array);
    }

    public static function arrayPartition(array $array, int $noOfColumns): array
    {
        return static ::arrayChunk($array, intval(ceil(count($array) / $noOfColumns)));
    }

    public static function arrayBucket(array $array, int $bucketSize)
    {
        $buckets = static ::arrayChunk($array, $bucketSize);
        $newArray = [];
        foreach ($buckets as $k => $bucket) $newArray[$k] = static ::arraySum($bucket) / count($bucket);
        return $newArray;
    }

    public static function arrayChunkVertical(array $array, int $columns): array
    {
        $listLength = count($array);
        $perColumn = floor($listLength / $columns);
        $rest = $listLength % $columns;
        $perColumns = [];
        for ($i = 0; $i < $columns; $i++) {
            $perColumns[$i] = $perColumn + ($i < $rest ? 1 : 0);
        }
        $tabular = [];
        foreach ($perColumns as $rows) {
            for ($i = 0; $i < $rows; $i++) {
                $tabular[$i][] = static ::arrayShift($array);
            }
        }
        return $tabular;
    }

    public static function arrayColumn(array $input, $columnKey, $indexKey = null): array
    {
        return array_column($input, $columnKey, $indexKey);
    }

    public static function arrayCombine(array $keys, array $values, bool $keepAllValues = false): array
    {
        if (Functions ::count($keys) == 0 && Functions ::count($values) == 0) {
            return array();
        }
        if ($keepAllValues) {
            return static ::arrayCombineWithValues($keys, $values);
        }
        return array_combine($keys, $values);
    }

    private static function arrayCombineWithValues(array $keys, array $values): array
    {
        $result = array();
        foreach ($keys as $i => $k) {
            $result[$k][] = $values[$i];
        }
        static ::arrayWalk($result, function (&$v) {
            if (Functions ::isArray($v) && Functions ::count($v) == 1) {
                $v = static ::arrayPop($v);
            }
        });
        return $result;
    }

    public static function arrayCountValues(array $array, string $column = null, $matchedKey = null)
    {
        if ($column !== null) {
            return static ::arrayCountValuesByColumn($array, $column, $matchedKey);
        }
        return array_count_values($array);
    }

    private static function arrayCountValuesByColumn(array $array, string $column, $matchedKey): int
    {
        return static ::arrayCountValues(static ::arrayColumn($array, $column))[$matchedKey];
    }

    public static function arrayDelete($value, array $array): array
    {
        return static ::arrayDiff($array, array($value));
    }

    public static function arrayDiffAssoc(array $array1, array $array2, ...$arrays): array
    {
        return Functions ::callUserFuncArray('array_diff_assoc', func_get_args());
    }

    public static function arrayDiffAssocRecursive(): array
    {
        $args = func_get_args();
        $diff = array();
        foreach (static ::arrayShift($args) as $key => $val) {
            for ($i = 0, $j = 0, $tmp = array($val), $count = count($args); $i < $count; $i++) {
                if (is_array($val)) {
                    if (!isset ($args[$i][$key]) || !is_array($args[$i][$key]) || empty($args[$i][$key])) {
                        $j++;
                    } else {
                        $tmp[] = $args[$i][$key];
                    }
                } elseif (!array_key_exists($key, $args[$i]) || (string)$args[$i][$key] !== (string)$val) {
                    $j++;
                }
            }
            if (is_array($val)) {
                $tmp = call_user_func_array([Arrays::class, 'arrayDiffAssocRecursive'], ...$tmp);
                if (!empty ($tmp)) $diff[$key] = $tmp;
                elseif ($j == $count) $diff[$key] = $val;
            } elseif ($j == $count && $count) $diff[$key] = $val;
        }
        return $diff;
    }

    public static function arrayDiffKey(array $array1, array $array2, ...$arrays): array
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

    public static function arrayDiff(array $array1, array $array2, ...$arrays): array
    {
        return Functions ::callUserFuncArray('array_diff', func_get_args());
    }

    public static function arraySlice(array $array, int $offset, int $length = null, bool $preserveKeys = false)
    {
        return array_slice($array, $offset, $length, $preserveKeys);
    }

    public static function arrayShift(array &$array)
    {
        return array_shift($array);
    }

    public static function arrayMerge()
    {
        return Functions ::callUserFuncArray('array_merge', func_get_args());
    }

    public static function arraySum(array $array)
    {
        return array_sum($array);
    }

    public static function arrayWalk(array &$array, callable $callback, $userdata = null)
    {
        array_walk($array, $callback, $userdata);
    }

    public static function arrayPop(array &$array)
    {
        return array_pop($array);
    }
}