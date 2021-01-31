<?php


/**
 * Groups the elements of an array by a given key.
 * 
 * ```
 * $data = [
 *   ['name' => 'AAA', 'class' => 1],
 *   ['name' => 'BBB', 'class' => 2],
 *   ['name' => 'CCC', 'class' => 2],
 * ];
 * 
 * $result = groupBy($data, ['class', 'name']);
 * ```
 * 
 * $result looks like
 * [
 *   1 => [
 *     'AAA' => [
 *       ['name' => 'AAA', 'class' => 1]
 *     ]
 *   ],
 *   2 => [
 *     'BBB' => [
 *       ['name' => 'BBB', 'class' => 2],
 *     ],
 *     'CCC' => [
 *       ['name' => 'CCC', 'class' => 2],
 *     ]
 *   ]
 * ]
 * 
 * @param array $array
 * @param array $keys
 * @return array
 */
function groupBy(array $array, array $keys) : array
    {
        $key = array_shift($keys);

        $grouped = [];

        foreach ($array as $index => $value) {  
            $groupKey = null;
            if (!is_string($key) && is_callable($key)) {  
                $groupKey = $key($value);   
            } else if (is_object($value)) { 
                $groupKey = $value->{$key};  
            } else {    
                $groupKey = $value[$key];   
            }   
            $grouped[$groupKey][$index] = $value;   
        }

        if (!empty($keys)) { 
            foreach ($grouped as $groupKey => $value) { 
                $grouped[$groupKey] = call_user_func_array([$this, 'groupBy'], [$value, $keys]); 
            }   
        }   

        return $grouped; 
    }

/**
 * variadic groupBy
 * 
 * ```
 * $result = groupBy($data, 'class', 'name');
 * ```
 * 
 * @param array $array
 * @param mixed $key
 * @return array
 */
function variadicGroupBy(array $array, $key, ...$otherKeys) : array
{
    $grouped = [];

    foreach ($array as $index => $value) { 
        $groupKey = null;
        if (!is_string($key) && is_callable($key)) { 
            $groupKey = $key($value);
        } else if (is_object($value)) {
            $groupKey = $value->{$key};
        } else {
            $groupKey = $value[$key];
        }
        $grouped[$groupKey][$index] = $value;
    }

    if (!empty($otherKeys)) {
        foreach ($grouped as $groupKey => $value) {
            $grouped[$groupKey] = call_user_func_array([$this, 'groupBy'], [
                $value,
                ...$otherKeys
            ]);
        }
    }

    return $grouped;
}