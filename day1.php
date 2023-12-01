<?php

$test_input = [
    'two1nine',
    'eightwothree',
    'abcone2threexyz',
    'xtwone3four',
    '4nineeightseven2',
    'zoneight234',
    '7pqrstsixteen',
];

require './input.php';

$replacements = [
    'one' => 'x1x',
    'two' => 'x2x',
    'three' => 'xx3xx',
    'four' => 'x4xx',
    'five' => 'x5xx',
    'six' => 'x6x',
    'seven' => 'xx7xx',
    'eight' => 'xx8xx',
    'nine' => 'x9xx'
];

$sum = 0;
$counter = 0;
foreach( $input as &$item ) {
    echo $item . PHP_EOL;
    $length = strlen( $item );
    $item1 = $item;
    for ( $i = 0; $i < $length; $i++ ) {
        foreach ( $replacements as $before => $after ) {

            /// echo "Looking at " . substr( $item, $i, 5) . PHP_EOL;
            $position = strpos( substr( $item, $i, 5), $before );
            if ( false !== $position ) {
                //  echo "Replacing $before with $after at $position with offset $i" . PHP_EOL;
                $item1 = substr_replace( $item, $after, $position + $i, strlen( $after ) );
                //echo "$item" . PHP_EOL;
                break 2;
            }
        }
    }

    //echo $item . PHP_EOL;
    $length = strlen( $item );
    for ( $i = 0; $i < $length; $i++ ) {
        foreach ( $replacements as $before => $after ) {

            //echo "Looking at " . substr( $item, -$i - 5, 5) . PHP_EOL;
            $position = strpos( substr( $item, - $i - 5, 5 ), $before );
            //echo "Position of $before is $position" . PHP_EOL;
            if ( false !== $position ) {
                //echo $position;
                //echo "Replacing $before with $after at $position with offset $i" . PHP_EOL;
                $item = substr_replace( $item1, $after, $length - $i - 5 + $position, strlen( $after ) );
                //echo "$item" . PHP_EOL;
                break 2;
            }
        }
    }

    preg_match_all( '/\d/', $item, $matches );
    if ( ! isset ( $matches[0][0] ) ) {
        die('wring');
    }

    $number = $matches[0][0] . $matches[0][ sizeof( $matches[0] ) - 1 ];
    echo $item . PHP_EOL;
    print_r( $number . PHP_EOL ) ;
    $sum += $number;
    echo $sum . PHP_EOL;
    $counter++;
}
echo sizeof( array_keys( $input ) ) . PHP_EOL;
echo $counter . PHP_EOL;
echo $sum . PHP_EOL;
