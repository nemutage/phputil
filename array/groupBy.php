<?php

/**
 * Groups an array by a given key. Any additional keys will be used for grouping
 * the next set of sub-arrays.
 * 
 * @param array $arr     The array to be grouped.
 * @param mixed $key,... A set of keys to group by.
 *
 * @return array
 */
function groupBy(array $array, $key) : array
{
    if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
        trigger_error('array_group_by(): The key should be a string, an integer, a float, or a function', E_USER_ERROR);
    }

    $isFunction = !is_string($key) && is_callable($key);

    $grouped = [];
    foreach ($array as $index => $value) {
        $groupKey = null;
        if ($isFunction) {
            $groupKey = $key($value);
        } else if (is_object($value)) {
           $groupKey = $value->{$key};
        } else {
            $groupKey = $value[$key];
        }
        $grouped[$groupKey][$index] = $value;
    }

    if (func_num_args() > 2) {
        $args = func_get_args();
        foreach ($grouped as $groupKey => $value) {
            $params = array_merge([$value], array_slice($args, 2, func_num_args()));
            $grouped[$groupKey] = call_user_func_array([$this, 'groupBy'], $params);
        }
    }

    return $grouped;
}