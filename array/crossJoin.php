<?php

/**
 * Cross join the given arrays.
 * 
 * ```
 * $data = [
 *   [1, 2],
 *   [3, 4],
 *   [5, 6],
 * ];
 * 
 * $result = crossJoin($data);
 * ```
 * 
 * $result looks like
 * [
 *   [1, 3, 5],
 *   [1, 3, 6],
 *   [1, 4, 5],
 *   [1, 4, 6],
 *   [2, 3, 5],
 *   [2, 3, 6],
 *   [2, 4, 5],
 *   [2, 4, 6],
 * ]
 * 
 * @param array $options
 * @return array
 */
function crossJoin(array $options): array
{
    $result = [];

    $stack = [[]];

    while (!empty($stack)) {
        $array = array_pop($stack);

        $count = count($array);

        if ($count === count($options)) {
            $result[] = $array;

            continue;
        }

        foreach ($options[$count] as $value) {
            $stack[] = array_merge($array, [$value]);
        }
    }

    return $result;
}
