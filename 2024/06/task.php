<?php

require 'input.php';

class Map {
    public $vertical = 0;
    public $horizontal = 0;

    // public $data = [];

    public $obstacles = [];

    public $start = [];

    public $path = [];

    public const UP = 1;
    public const RIGHT = 2;
    public const DOWN = 4;
    public const LEFT = 8;

    public $direction = self::UP;

    public const VECTORS = [
        self::UP => [ -1, 0 ],
        self::RIGHT => [ 0, 1 ],
        self::DOWN => [ 1, 0 ],
        self::LEFT => [ 0, -1 ],
    ];

    public function __construct( $input ) {
        $this->vertical = sizeof( $input );

        foreach ( $input as $index => $line ) {
            if ( 0 === $this->horizontal ) {
				$this->horizontal = strlen( $line );
            }

            $this->obstacles[ $index ] = [];
            for ( $i = 0; $i < strlen( $line ); $i++ ) {
                $entry = substr( $line, $i, 1 );
                $this->obstacles[ $index ][ $i ] = false;

                switch( $entry ) {
				case '#':
					$this->obstacles[ $index ][ $i ] = true;
					break;
				case '^':
					$this->start = [ $index, $i ];
				case '.':
				default:
					$this->obstacles[ $index ][ $i ] = false;
                }
            }
        }

        $this->data[ $this->start[0] ] = [];
        $this->data[ $this->start[0] ][ $this->start[1] ] = true;
    }

    public function move( $direction = self::UP, $coordinates = [] ) {
        if ( empty( $coordinates ) ) {
            $coordinates = $this->start;
        }

        list( $new_coordinates, $new_direction ) = $this->adjust( $coordinates, $direction );

        if ( false === $new_coordinates ) {
            return false;
        } else {
            $this->path[] = $new_coordinates;
        }

        $this->data[ $new_coordinates[0] ] ??= [];
        if (
            isset( $this->data[ $new_coordinates[0] ][ $new_coordinates[1] ] )
                && $new_direction === $this->data[ $new_coordinates[0] ][ $new_coordinates[1] ]
        ) {
            throw new Exception( "this path loops" );
        } elseif ( isset( $this->data[ $new_coordinates[0] ][ $new_coordinates[1] ] ) ) {
            //echo "This path revisits " . $new_coordinates[0] . ", " . $new_coordinates[1] . PHP_EOL;
        }
        $this->data[ $new_coordinates[0] ][ $new_coordinates[1] ] = $new_direction;

        return $this->move( $new_direction, $new_coordinates );
    }

    public function clear() {
        $this->data = [];
    }

    public function adjust( $coordinates, $direction ) {
        $vector = self::VECTORS[ $direction ];
        $new_coordinates = [ $coordinates[0] + $vector[0], $coordinates[1] + $vector[1] ];

        if (
            $new_coordinates[0] < 0
                || $new_coordinates[0] >= $this->vertical
                || $new_coordinates[1] < 0
                || $new_coordinates[1] >= $this->horizontal
        ) {
            return [ false, false ];
        }

        if ( true === $this->obstacles[ $new_coordinates[0] ][ $new_coordinates[1] ] ) {
            $new_direction = $direction << 1;
            if( $new_direction > self::LEFT ) {
                $new_direction = self::UP;
            }
            return $this->adjust( $coordinates, $new_direction );
        }

        return [ $new_coordinates, $direction ];
    }
}

$map = new Map( $input );
$map->move();

// print_r( $map->data );
$count = 0;
array_walk_recursive(
    $map->data,
    function( $key, $item ) use ( &$count ) {
        // echo "$key: $item" . PHP_EOL;
        $count++;
    }
);
echo $count . PHP_EOL;

$path_data = $map->data;
//print_r( $path_data );

$loops = 0;
foreach ( $path_data as $vertical => $data ) {
    foreach ( $data as $horizontal => $direction ) {
        if ( $vertical === $map->start[0] && $horizontal === $map->start[1] ) {
            // echo "Skipping start point at " . $vertical . ", " . $horizontal . PHP_EOL;
            continue;
        }

        $map->clear();
        $map->obstacles[ $vertical ][ $horizontal ] = true;

        try {
            $map->move();
        } catch ( Exception $e ) {
            $loops++;
            echo "Caught a loop with an obstacle at " . $vertical . ", " . $horizontal . PHP_EOL;
        }

        $map->obstacles[ $vertical ][ $horizontal ] = false;
    }
}

echo "Number of loops: " . $loops . PHP_EOL;
