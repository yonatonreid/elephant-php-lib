<?php

declare(strict_types=1);

namespace Elephant\Env;

use http\Exception\InvalidArgumentException;
use function array_change_key_case;
use function array_chunk;
use function array_column;
use function array_combine;
use function array_count_values;
use function array_map;
use function is_array;


class Arrays
{
    public static function arrayChangeKeyCase(array $array, int $case = CASE_LOWER): array
    {
        return array_change_key_case($array, $case);
    }

    public static function arrayChangeKeyCaseRecursive(array $array, int $case = CASE_LOWER): array
    {
        return array_map(function ($item) use ($case) {
            if (Functions ::isArray($item))
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
            if (Functions ::isArray($item))
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

    public static function arrayDeleteRecursive($array, $value)
    {
        $h = array();
        foreach ($array as $k => $v) {
            if (Functions ::isArray($v)) {
                $i = static ::arrayDelete($value, $v);
                if (!Functions ::empty($i)) {
                    $h[$k] = $i;
                }
            } elseif ($value != $v) {
                $h[$k] = $v;
            }
        }
        return $h;
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
                if (Functions ::isArray($val)) {
                    if (!isset ($args[$i][$key]) || !Functions ::isArray($args[$i][$key]) || Functions ::empty($args[$i][$key])) {
                        $j++;
                    } else {
                        $tmp[] = $args[$i][$key];
                    }
                } elseif (!static ::arrayKeyExists($key, $args[$i]) || (string)$args[$i][$key] !== (string)$val) {
                    $j++;
                }
            }
            if (is_array($val)) {
                $tmp = Functions ::callUserFuncArray([Arrays::class, 'arrayDiffAssocRecursive'], $tmp);
                if (!Functions ::empty($tmp)) {
                    $diff[$key] = $tmp;
                } elseif ($j == $count) {
                    $diff[$key] = $val;
                }
            } elseif ($j == $count && $count) {
                $diff[$key] = $val;
            }
        }
        return $diff;
    }

    public static function arrayDiffKey(array $array1, array $array2, ...$arrays): array
    {
        return Functions ::callUserFuncArray('array_diff_key', func_get_args());
    }

    public static function arrayDiffKeyUnique(array $array1, array $array2): array
    {
        return static ::arrayMerge(static ::arrayDiffKey($array1, $array2), static ::arrayDiffKey($array2, $array1));
    }

    public static function arrayDiffKeyRecursive(array $arr1, array $arr2): array
    {
        $diff = static ::arrayDiffKey($arr1, $arr2);
        $intersect = array_intersect_key($arr1, $arr2);
        foreach ($intersect as $k => $v) {
            if (Functions ::isArray($arr1[$k]) && Functions ::isArray($arr2[$k])) {
                $d = static ::arrayDiffKeyRecursive($arr1[$k], $arr2[$k]);
                if ($d) {
                    $diff[$k] = $d;
                }
            }
        }
        return $diff;
    }

    public static function arrayReorder(&$array, $list, $keepRemaining = true, $prepend = false, $preserveKeys = true)
    {
        $t = array();
        foreach ($list as $i) {
            if (isset($array[$i])) {
                $tempVal = static ::arraySlice($array, array_search($i, array_keys($array)), 1, $preserveKeys);
                $t[$i] = static ::arrayShift($tempVal);
                unset($array[$i]);
            }
        }
        $array = $keepRemaining ? ($prepend ? $array + $t : $t + $array) : $t;
        return $array;
    }

    public static function arraySameKeys(array $array1, array $array2): bool
    {
        return static ::hasSameKeys($array1, $array2) && static ::hasSameKeys($array2, $array1);
    }

    private static function hasSameKeys(array $a1, array $a2): bool
    {
        $same = false;
        if (!array_diff_key($a1, $a2)) {
            $same = true;
            foreach ($a1 as $k => $v) {
                if (is_array($v) && !static ::hasSameKeys($v, $a2[$k])) {
                    $same = false;
                    break;
                }
            }
        }
        return $same;
    }

    public static function arrayFillKeys(array $keys, $value, bool $intersect = false): array
    {
        if ($intersect) {
            $filledArray = array();
            if (Functions ::isArray($keys) && Functions ::isArray($value)) {
                foreach ($keys as $key => $v) {
                    $filledArray[$v] = $value[$key];
                }
            } else {
                throw new InvalidArgumentException("Both keys and value must be arrays for intersection");
            }
            return $filledArray;
        }
        return array_fill_keys($keys, $value);
    }

    public static function arrayNukeKeys(array $keys, array $arr)
    {
        return static ::arrayDiffKey($arr, static ::arrayFillKeys($keys, 0));
    }

    public static function arrayDiffUassoc(): array
    {
        return Functions ::callUserFuncArray('array_diff_uassoc', func_get_args());
    }

    public static function arrayDiffUkey(): array
    {
        return Functions ::callUserFuncArray('array_diff_ukey', func_get_args());
    }

    public static function arraySliceAssoc($array, $keys)
    {
        return array_intersect_key($array, array_flip($keys));
    }

    public static function arraySliceAssocInverse($array, $keys)
    {
        return array_diff_key($array, array_flip($keys));
    }

    public static function arrayChop(&$array, $num): array
    {
        $ret = static ::arraySlice($array, 0, $num);
        $array = static ::arraySlice($array, $num);
        return $ret;
    }

    public static function arrayDiff(array $array1, array $array2, ...$arrays): array
    {
        return Functions ::callUserFuncArray('array_diff', func_get_args());
    }

    public static function arrayIdenticalValues(array $array1, array $array2): bool
    {
        sort($array1);
        sort($array2);
        return $array1 === $array2;
    }

    public static function arraySlice(array $array, int $offset, int $length = null, bool $preserveKeys = false)
    {
        return array_slice($array, $offset, $length, $preserveKeys);
    }

    public static function arrayShift(array &$array)
    {
        return array_shift($array);
    }

    public static function arrayMerge(array $array1, array $array2, ...$arrays)
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

    public static function arrayKeyExists($key, $arr)
    {
        return array_key_exists($key, $arr);
    }

    public static function arrayCheck($key, $arr)
    {
        return isset($arr[$key]) || static ::arrayKeyExists($key, $arr);
    }

    public static function arrayUnpop(array &$array)
    {
        $args = func_get_args();
        unset($args[0]);
        $t = array();
        foreach ($args as $arg) {
            $t[] = $arg;
        }
        return static ::arrayMerge($array, $t);
    }

    public static function arrayPick(array &$array, $keys)
    {
        if (Functions ::isScalar($keys)) {
            $keys = array($keys);
        }
        $resultArray = array();
        foreach ($keys as $key) {
            if (Functions ::isScalar($key)) {
                if (static ::arrayKeyExists($key, $array)) {
                    $resultArray[$key] = $array[$key];
                    unset($array[$key]);
                }
            } else {
                return false;
            }
        }
        return $resultArray;
    }

    public static function arrayZip(&$data, $glue)
    {
        if (!Functions ::isArray($data)) {
            throw new InvalidArgumentException("First parameter must be an array");
        }
        static ::arrayWalk($data, function (&$value, $key, $joinUsing) {
            $value = $key . $joinUsing . $value;
        }, $glue);
    }
}