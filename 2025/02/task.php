<?php

require __DIR__ . '/input.php';

// $input = $test_input;

function is_silly( string $number ): bool {
    if ( strlen( $number ) % 2 ) {
        // echo $number . " is not silly" . PHP_EOL;
        $is_mono = is_mono_silly( $number );
        if ( $is_mono ) {
            return true;
        }
    }

    $first = substr( $number, 0, strlen( $number ) / 2 );
    $last  = substr( $number, strlen( $number ) / 2 );

    if ( strlen( $number ) % 2 == 0 && (int) $first === (int) $last ) {
        echo $number . " is silly" . PHP_EOL;
        return true;
    } else {
        // echo $number . " is not silly" . PHP_EOL;
        return is_dual_silly( $number )
            || is_triple_silly( $number );
    }
}

function is_mono_silly( string $number ): bool {
    $pattern = null;
    for ( $i = 0; $i < strlen( $number ); $i++ ) {
        $next = $number[$i];
        if ( $pattern !== null && $pattern != $next ) {
            return false;
        }
        $pattern = $next;
    }
    echo $number . " is mono silly" . PHP_EOL;
    return true;
}

function is_dual_silly( string $number ): bool {
    $pattern = null;
    $strlen  = strlen( $number );
    if ( $strlen === 2 ) {
        return false;
    }

    for ( $i = 0; $i < $strlen; $i += 2 ) {
        if ( $i + 1 === $strlen ) {
            return false;
        }
        $next = $number[$i] . $number[$i+1];
        if ( $pattern !== null && $pattern != $next ) {
            return false;
        }
        $pattern = $next;
    }
    echo $number . " is dual silly" . PHP_EOL;
    return true;
}

function is_triple_silly( string $number ): bool {
    $pattern = null;
    $strlen  = strlen( $number );
    if ( $strlen === 3 ) {
        return false;
    }

    for ( $i = 0; $i < strlen( $number ); $i += 3 ) {
        if ( $i + 2 >= $strlen ) {
            return false;
        }
        $next = $number[$i] . $number[$i+1] . $number[$i+2];
        if ( $pattern !== null && $pattern != $next ) {
            return false;
        }
        $pattern = $next;
    }
    echo $number . " is triple silly" . PHP_EOL;
    return true;
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
