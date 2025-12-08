<?php

require __DIR__ . '/input.php';

class Jolter {
    private array $batteries = array();

    public function __construct( string $plan ) {
        $this->batteries = str_split( $plan, 1 );
    }

    public function getStartingPositions( int $digits ): array {
        return array_keys( array_fill( 0, count( $this->batteries ) - $digits + 1, 0 ) );
    }

    public function getMaxNumber( int $digits ): int {
        $max = 0;
        $indices = $this->getStartingPositions( $digits );

        foreach( $indices as $key ) {
            $candidate = $this->permutate( $this->batteries, $key, $digits );
            if ( $candidate > $max ) {
                $max = $candidate;
            }
        }
        return $max;
    }

    public function permutate( array $batteries, int $index, int $digits ): int {
        if ( ! isset( $batteries[ $index ] ) ) {
            return 0;
        }

        $current = $batteries[ $index ];

        if ( $digits == 1 ) {
            return $current;
        }

        $next_digits = array();
        for ( $i = $index + 1; $i < count( $batteries ); $i++ ) {
            $next_digits[ $i ] = $batteries[ $i ];
        }

        arsort( $next_digits );

        foreach ( array_keys( $next_digits ) as $key ) {
            $next_permutation = $this->permutate( $batteries, $key, $digits - 1 );

            if ( $next_permutation == 0 ) {
                continue;
            }

            return (int) $current . $next_permutation;
        }
        return 0;
    }
}

$sum = 0;
foreach ( $input as $plan ) {
    $jolter = new Jolter( $plan );
    $joltage = $jolter->getMaxNumber( 12 );
    echo $plan . PHP_EOL;
    echo $joltage . PHP_EOL;
    $sum += $joltage;
}
echo $sum . PHP_EOL;
