<?php

require __DIR__ . '/input.php';

class Fridge {
    private $ranges = [];
    private $ingredients = [];

    public function __construct( array $input ) {
        $stop = false;
        foreach ( $input as $line ) {
            if ( empty( $line ) ) {
                $stop = true;
                continue;
            }

            if ( $stop ) {
                $this->addIngredient( $line );
            } else {
                $this->addRange( $line );
            }
        }
    }

    public function addRange( string $range ): void {
        list( $start, $end ) = explode( '-', $range );
        $this->ranges[] = [ (int) $start, (int) $end ];
    }

    public function addIngredient( string $ingredient ): void {
        $this->ingredients[] = (int) $ingredient;
    }

    public function isInRange( int $ingredient ): bool {
        foreach ( $this->ranges as $range ) {
            if ( $ingredient >= $range[0] && $ingredient <= $range[1] ) {
                return true;
            }
        }
        return false;
    }

    public function collapseRanges(): void {
        $merged = true;
        while ( $merged ) {
            $merged = false;
            foreach ($this->ranges as $key => $range) {
                if ($range[0] === -1) {
                    continue;
                }

                $overlappingKey = $this->getOverlappingRange($key);

                if (false === $overlappingKey) {
                    continue;
                }

                list($start, $end) = $range;
                list($newStart, $newEnd) = $this->ranges[$overlappingKey];

                $this->ranges[$key][0] = min($start, $newStart);
                $this->ranges[$key][1] = max($end, $newEnd);

                $this->ranges[$overlappingKey] = [-1, -1];
                $merged = true;
            }
        }
    }

    private function getOverlappingRange( int $key ): int|false {
        list ( $start, $end ) = $this->ranges[ $key ];

        foreach( $this->ranges as $newKey => $newRange ) {
            if ( $newKey === $key ) {
                continue;
            }
            list ( $newStart, $newEnd ) = $newRange;

            if ( $newStart === -1 ) {
                continue; // Skip deleted ranges
            }

            if ( $start <= $newStart && $end >= $newEnd ) {
                // newRange is contained inside range
                return $newKey;
            }

            if ( $start >= $newStart && $end <= $newEnd ) {
                // range is contained inside newRange
                return $newKey;
            }

            if ( $start <= $newStart && $end <= $newEnd ) {
                if ( $end >= $newStart ) {
                    return $newKey;
                }
            }

            if ( $start >= $newStart && $end >= $newEnd ) {
                if ( $start <= $newEnd ) {
                    return $newKey;
                }
            }
        }
        return false;
    }

    public function getTotalFreshOptions(): int {
        $this->collapseRanges();
        $count = 0;
        foreach( $this->ranges as $key => $range ) {
            if ( $range[0] === -1 ) {
                continue;
            }

            $count += $range[1] - $range[0] + 1;
        }
        return $count;
    }

    public function getFreshCount(): int {
        $count = 0;
        foreach ( $this->ingredients as $ingredient ) {
            if ( $this->isInRange( $ingredient ) ) {
                $count++;
            }
        }
        return $count;
    }
}

$fridge = new Fridge( $input );
echo $fridge->getFreshCount() . PHP_EOL;

//$fridge->collapseRanges();
echo $fridge->getTotalFreshOptions() . PHP_EOL;
