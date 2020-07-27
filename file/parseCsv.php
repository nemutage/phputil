<?php

/**
 * Reads CSV line by line and executes callback
 * 
 * @param string $path file path
 * @param \Closure $callback
 * @return mixed errors
 */
function parseCsv($path, $callback)
{
    $file = new SplFileObject($path);
    $file->setFlags(
        SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
    );

    foreach ($file as $values) {
        $errors = $callback($values);
        if (isset($errors)) {
            return $errors;
        }
    }
}