<?php declare( strict_types=1 );

require __DIR__ . '/input.php';

class Dial {
    protected int $state = 0;
    protected int $zeroClicks = 0;

    public function __construct( $initialState = 0 ) {
        $this->state = $initialState;
    }

    public function rotate( string $rotation ): void {
        // echo PHP_EOL . $this->state . ', ' . $rotation . ':' . "\t\t";
        $direction = $rotation[0];
        $amount    = intval( substr( $rotation, 1 ) );

        match ( $direction ) {
            'L' => $this->rotateLeft( $amount ),
            'R' => $this->rotateRight( $amount )
        };
    }

    public function rotateLeft( int $number ): void {
        $number = $this->remainder( $number );

        if ( $this->state > $number ) {
            // echo "Simple left";
            $this->state -= $number;
        } elseif ( $this->state == $number ) {
            // echo "Zero after left";
            $this->state = 0;
            $this->zeroClicks++;
        } else {
            if ( $this->state != 0 ) {
                // echo "Click left";
                $this->zeroClicks++;
            }
            $this->state = ( $this->state + 100 ) - $number;
        }
    }

    public function rotateRight( int $number ): void {
        $number = $this->remainder( $number );

        if ( $number + $this->state < 100 ) {
            // echo "Simple right";
            $this->state += $number;
        } elseif ( $number + $this->state == 100 ) {
            // echo "Zero after right";
            $this->state = 0;
            $this->zeroClicks++;
        } else {
            // echo "Click right";
            $this->state = $this->state + $number - 100;
            $this->zeroClicks++;
        }
    }

    public function remainder( int $number ): int {
        $remainder = $number % 100;

        $extra = intval( ( $number - $remainder ) / 100 );
        if ( $extra > 0 ) {
            // echo "Plus " . $extra . "clicks\t";
            $this->zeroClicks += $extra;
        }
        return $remainder;
    }

    public function getState(): int {
        return $this->state;
    }

    public function getZeroClicks(): int {
        return $this->zeroClicks;
    }
}

// $input = $test_input;

$dial = new Dial( 50 );
$count = 0;

foreach( $input as $rotation ) {
    $dial->rotate( $rotation );
    $state = $dial->getState();
    // echo $state . PHP_EOL;
    if ( $state === 0 ) {
        //echo "Zero!" . PHP_EOL;
        $count++;
    }
}

// echo $count . PHP_EOL;
echo $dial->getZeroClicks() . PHP_EOL;
