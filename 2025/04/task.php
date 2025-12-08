<?php

require __DIR__ . '/input.php';

class Map {
    public $vertical = 0;
    public $horizontal = 0;

    public $rolls = [];

    public $start = [];

    public $path = [];

    public const UP = 1;
    public const RIGHT = 2;
    public const DOWN = 4;
    public const LEFT = 8;

    public const TOP_LEFT     = self::UP | self::LEFT;
    public const BOTTOM_LEFT  = self::DOWN | self::LEFT;
    public const TOP_RIGHT    = self::UP | self::RIGHT;
    public const BOTTOM_RIGHT = self::DOWN | self::RIGHT;

    public $direction = self::UP;

    public const VECTORS = [
        self::UP    => [ -1, 0 ],
        self::RIGHT => [ 0, 1 ],
        self::DOWN  => [ 1, 0 ],
        self::LEFT  => [ 0, -1 ],
    ];

    public const AROUND = [
        self::UP           => [ -1, 0 ],
        self::RIGHT        => [ 0, 1 ],
        self::DOWN         => [ 1, 0 ],
        self::LEFT         => [ 0, -1 ],
        self::TOP_LEFT     => [ -1, -1 ],
        self::BOTTOM_LEFT  => [ 1, -1 ],
        self::TOP_RIGHT    => [ -1, 1 ],
        self::BOTTOM_RIGHT => [ 1, 1 ],
    ];

    public function __construct( $input ) {
        $this->vertical = sizeof( $input );

        foreach ( $input as $index => $line ) {
            if ( 0 === $this->horizontal ) {
                $this->horizontal = strlen( $line );
            }

            $this->rolls[ $index ] = [];
            for ( $i = 0; $i < strlen( $line ); $i++ ) {
                $entry = substr( $line, $i, 1 );
                $this->rolls[ $index ][ $i ] = false;

                if ( $entry === '@' ) {
                    $this->rolls[ $index ][ $i ] = true;
                }
            }
        }
    }

    public function hasRoll( $coordinates, $vector ): bool {
        $new_coordinates = [ $coordinates[0] + $vector[0], $coordinates[1] + $vector[1] ];

        if (
            $new_coordinates[0] < 0
                || $new_coordinates[0] >= $this->vertical
                || $new_coordinates[1] < 0
                || $new_coordinates[1] >= $this->horizontal
        ) {
            return false;
        }

        return $this->rolls[ $new_coordinates[0] ][ $new_coordinates[1] ];
    }

    public function getMovableCount(): int {
        $movable = 0;

        for ( $i = 0; $i < $this->vertical; $i++ ) {
            for ( $j = 0; $j < $this->horizontal; $j++ ) {
                if ( ! $this->hasRoll( [ $i, $j ], [ 0, 0 ] ) ) {
                    continue;
                }

                if ( $this->isMovable( [ $i, $j ] ) ) {
                    echo "Roll $i:$j is movable" . PHP_EOL;
                    $movable++;
                }
            }
        }
        return $movable;
    }

    public function isMovable( $coordinates ): bool {
        $adjacent_rolls = 0;
        foreach ( self::AROUND as $vector ) {
            if ( $this->hasRoll( $coordinates, $vector ) ) {
                $adjacent_rolls++;
            }
        }
        return $adjacent_rolls < 4;
    }

    public function printMap(): void {
        for ( $i = 0; $i < $this->vertical; $i++ ) {
            for ( $j = 0; $j < $this->horizontal; $j++ ) {
                if ( $this->rolls[ $i ][ $j ] ) {
                    print $this->isMovable( [ $i, $j ] ) ? 'x' : '@';
                } else {
                    print '.';
                }
            }
            print PHP_EOL;
        }
    }

    public function removeRolls(): int {
        $movable = 0;

        for ( $i = 0; $i < $this->vertical; $i++ ) {
            for ( $j = 0; $j < $this->horizontal; $j++ ) {
                if ( ! $this->hasRoll( [ $i, $j ], [ 0, 0 ] ) ) {
                    continue;
                }

                if ( $this->isMovable( [ $i, $j ] ) ) {
                    $movable++;
                    $this->rolls[ $i ][ $j ] = false;
                }
            }
        }

        if ( $movable > 0 ) {
            return $movable + $this->removeRolls();
        } else {
            return 0;
        }
    }
}

$map = new Map( $input );
// $map->printMap();
echo $map->removeRolls() . PHP_EOL;
