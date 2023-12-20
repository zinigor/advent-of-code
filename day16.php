<?php

require './input16.php';

class Grid {
	protected array $rows = [];

	protected array $powered_tiles = [];

	protected int $abs;

	protected int $ord;

	public function __construct( $input ) {
		foreach ( explode( "\n", $input ) as $row ) {
			$this->rows[] = $row;
		}

		$this->abs = strlen( $this->rows[0] );
		$this->ord = count( $this->rows );
	}

	public function reset(): void {
		$this->powered_tiles = [];
	}

	public function get_dimensions(): array {
		return [ $this->abs, $this->ord ];
	}

	public function get_element( $abs, $ord ) {
		if (
			$abs < 0
			|| $abs >= $this->abs
			|| $ord < 0
			|| $ord >= $this->ord
		) {
			return false;
		}

		return $this->rows[ $ord ][ $abs ];
	}

	public function power_tile( $abs, $ord, $direction ): void {
		$this->powered_tiles[ $ord ] ??= [];
		$this->powered_tiles[ $ord ][ $abs ] = $direction;
	}

	public function is_powered( $abs, $ord, $direction ): bool {
		return
			isset( $this->powered_tiles[ $ord ][ $abs ] )
			&& $direction === $this->powered_tiles[ $ord ][ $abs ];
	}

	public function get_powered_count(): int {
		$count = 0;
		foreach ( $this->powered_tiles as $row ) {
			$count += count( $row );
		}
		return $count;
	}

	public function print_powered_grid(): void {
		for ( $j = 0; $j < $this->ord; $j++ ) {
			for ( $i = 0; $i < $this->abs; $i++ ) {
				if ( isset ( $this->powered_tiles[ $j ][ $i ] ) ) {
					print( '#' );
				} else {
					print( '.' );
				}
			}
			print( "\n" );
		}
   }
}

class Beam {

    static int $counter = 0;

	const UP    = 0;
	const RIGHT = 1;
	const DOWN  = 2;
	const LEFT  = 3;

	const DIRECTIONS =
					 [
						 self::UP    => [
							 '-' => [ self::LEFT, self::RIGHT ],
							 '|' => [ self::DOWN ],
							 '/' => [ self::LEFT ],
							 '\\' => [ self::RIGHT ],
							 '.' => [ self::DOWN ],
						 ],
						 self::DOWN    => [
							 '-' => [ self::LEFT, self::RIGHT ],
							 '|' => [ self::UP ],
							 '/' => [ self::RIGHT ],
							 '\\' => [ self::LEFT ],
							 '.' => [ self::UP ],
						 ],
						 self::LEFT    => [
							 '-' => [ self::RIGHT ],
							 '|' => [ self::DOWN, self::UP ],
							 '/' => [ self::UP ],
							 '\\' => [ self::DOWN ],
							 '.' => [ self::RIGHT ],
						 ],
						 self::RIGHT    => [
							 '-' => [ self::LEFT ],
							 '|' => [ self::DOWN, self::UP ],
							 '/' => [ self::DOWN ],
							 '\\' => [ self::UP ],
							 '.' => [ self::LEFT ],
						 ],
					 ];

	public function __construct( Grid $grid, $abs, $ord, $direction ) {
		//if ( self::$counter > 500 ) return;
		$element = $grid->get_element( $abs, $ord );
		if ( false === $element ) {
			return;
		}

		if ( $grid->is_powered( $abs, $ord, $direction ) ) {
			//printf( "Beam %d:%d already powered %s\n", $abs, $ord, self::get_direction_text( $direction ) );
			return;
		}
		$grid->power_tile( $abs, $ord, $direction );
		//self::$counter++;

		$next_directions = self::DIRECTIONS[ $direction ];
		$next_directions = $next_directions[ $element ];

		foreach ( $next_directions as $next_direction ) {
			//printf( "Beam %d:%d going %s\n", $abs, $ord, self::get_direction_text( $next_direction ) );
			list ( $next_abs, $next_ord ) = $this->direct( $abs, $ord, $next_direction );
			new Beam( $grid, $next_abs, $next_ord, $this->reverse( $next_direction ) );
		}
	}

	static public function get_direction_text( $direction ) {
		switch ( $direction ) {
		case self::UP:
			return 'up';
		case self::DOWN:
			return 'down';
		case self::LEFT:
			return 'left';
		case self::RIGHT:
			return 'right';
		}
	}

	public function reverse( $direction ) {
		switch ( $direction ) {
		case self::UP:
			return self::DOWN;
		case self::DOWN:
			return self::UP;
		case self::LEFT:
			return self::RIGHT;
		case self::RIGHT:
			return self::LEFT;
		}
	}

	public function direct( $abs, $ord, $direction ) {
		switch ( $direction ) {
		case self::UP:
			return [ $abs, $ord - 1 ];
		case self::DOWN:
			return [ $abs, $ord + 1 ];
		case self::LEFT:
			return [ $abs - 1, $ord ];
		case self::RIGHT:
			return [ $abs + 1, $ord ];
		}
   }
}

$grid = new Grid( $input );
//new Beam( $grid, 0, 0, Beam::LEFT );

//print_r( $grid->get_powered_count() . PHP_EOL );
//$grid->print_powered_grid();

$max_count = 0;
$max_setup = null;
list( $abs, $ord ) = $grid->get_dimensions();

for( $j = 0; $j < $ord; $j++ ) {
    for( $i = 0; $i < $ord; $i++ ) {
        if (
            $j !== 0
            && $j !== $ord - 1
            && $i !== 0
            && $i !== $abs - 1
        ) {
            continue;
        }

        if ( $j === 0 || $j === $ord - 1 ) {
            if ( $j === 0 ) {
                $direction = Beam::UP;
            } elseif ( $j === $ord - 1 ) {
                $direction = Beam::DOWN;
            }

            printf( "Processing vertical %s from %d\n", Beam::get_direction_text( $direction ), $i );
            new Beam( $grid, $i, $j, $direction );

            $count = $grid->get_powered_count();
            if ( $count > $max_count ) {
                $max_setup = [ $i, $j, $direction ];
                $max_count = $count;
            }
			$grid->reset();
        }

        if ( $i === 0 || $i === $abs - 1 ) {
            if ( $i === 0 ) {
                $direction = Beam::LEFT;
            } elseif ( $i === $abs - 1 ) {
                $direction = Beam::RIGHT;
            }

            printf( "Processing horizontal %s from %d\n", Beam::get_direction_text( $direction ), $j );
            new Beam( $grid, $i, $j, $direction );

            $count = $grid->get_powered_count();
            if ( $count > $max_count ) {
                $max_setup = [ $i, $j, $direction ];
                $max_count = $count;
            }
			$grid->reset();
        }
    }
}

print_r( $max_count );
print_r( $max_setup );
