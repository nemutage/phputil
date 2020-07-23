# array

## groupBy

sample1
``` php
$records = [
    [
        'state'  => 'IN',
        'city'   => 'Indianapolis',
        'object' => 'School bus',
    ],
    [
        'state'  => 'IN',
        'city'   => 'Indianapolis',
        'object' => 'Manhole',
    ],
    [
        'state'  => 'IN',
        'city'   => 'Plainfield',
        'object' => 'Basketball',
    ],
    [
        'state'  => 'CA',
        'city'   => 'San Diego',
        'object' => 'Light bulb',
    ],
    [
        'state'  => 'CA',
        'city'   => 'Mountain View',
        'object' => 'Space pen',
    ],
];

$grouped = $this->groupBy($records, 'state', 'city');
```

sample1 output
``` text
Array
(
    [IN] => Array
        (
            [Indianapolis] => Array
                (
                    [0] => Array
                        (
                            [state] => IN
                            [city] => Indianapolis
                            [object] => School bus
                        )

                    [1] => Array
                        (
                            [state] => IN
                            [city] => Indianapolis
                            [object] => Manhole
                        )

                )

            [Plainfield] => Array
                (
                    [0] => Array
                        (
                            [state] => IN
                            [city] => Plainfield
                            [object] => Basketball
                        )

                )

        )

    [CA] => Array
        (
            [San Diego] => Array
                (
                    [0] => Array
                        (
                            [state] => CA
                            [city] => San Diego
                            [object] => Light bulb
                        )

                )

            [Mountain View] => Array
                (
                    [0] => Array
                        (
                            [state] => CA
                            [city] => Mountain View
                            [object] => Space pen
                        )

                )

        )
)
```


sample2
``` php
$grouped = $this->groupBy($records, function ($row) {
    return $row->city;
});
```
