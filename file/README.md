# file

## parseCsv

sample1
``` php
$errors = $this->parseCsv($path, function ($values) {
    // validate size of values
    $csvColumns = $this->csvColumns();
    if (!$this->arraySizeEquals($csvColumns, $values)) {
        return ['incorrect format'];
    }
    // combine and validate content of values
    $values = $this->combineArray($csvColumns, $values);
    if ($errors = $this->validateCsv($values)) {
        return $errors;
    }
    // save values
    if (!$this->save($values)) {
        return ['registration failed'];
    }
});
```