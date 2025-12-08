<?php

require __DIR__ . '/input.php';

// $input = $test_input;

function is_silly(string $number): bool {
    $len = strlen($number);

    // Try all possible pattern lengths from 1 to len/2
    for ( $pattern_len = 1; $pattern_len <= $len / 2; $pattern_len++ ) {
        // Pattern must divide evenly into the total length
        if ($len % $pattern_len !== 0) {
            continue;
        }

        // Must repeat at least twice
        $repetitions = $len / $pattern_len;
        if ( $repetitions < 2 ) {
            continue;
        }

        $pattern = substr( $number, 0, $pattern_len );

        // Check if the entire string is this pattern repeated
        if ( str_repeat( $pattern, $repetitions ) === $number ) {
            echo "$number is silly (pattern '$pattern' x $repetitions)" . PHP_EOL;
            return true;
        }
    }

    return false;
}

$result = 0;
foreach ( $input as $range ) {
    list( $start, $end ) = explode( '-', $range );

    for( $i = (int) $start; $i <= (int) $end; $i++ ) {
        if ( is_silly( (string) $i ) ) {
            // echo (string) $i . PHP_EOL;
            $result += $i;
        }
    }
}
echo $result;
