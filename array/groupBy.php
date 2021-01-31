<?php

/**
 * Groups the elements of an array by a given key.
 * 
 * @param array $array
 * @param mixed $key
 * @return array
 */
function groupBy(array $array, $key) : array
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

    if (func_num_args() > 2) {  
        $args = func_get_args();    
        foreach ($grouped as $groupKey => $value) { 
            $grouped[$groupKey] = call_user_func_array([$this, 'groupBy'], [
                $value,
                ...array_slice($args, 2, func_num_args())
            ]); 
        }   
    }   

    return $grouped; 
}
