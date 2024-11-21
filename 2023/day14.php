<?php

require './input14.php';

class TiltMap {

protected array $rows = [];

	public function __construct( $input ) {
		foreach ( explode( "\n", $input ) as $row ) {
			$this->rows[] = $row;
		}
	}

	public function print_map(): void {
		foreach ( $this->rows as $index => $row ) {
			printf( "%3d %s\n", $index, $row );
		}
	}

	public function get_hash(): string {
		return md5( implode( '', $this->rows ) );
	}

	public function tilt( $direction ): array {
		$moves = 0;
		do {
			$moved_amount = 0;
			foreach ( $this->rows as $ord => $row ) {
				foreach ( str_split( $row, 1 ) as $abs => $char ) {
					if ( 'O' !== $char ) {
						continue;
					}
					// printf( "Moving element %s at (%d, %d).\n", $char, $abs, $ord );
					$moved_amount += $this->move_rock( $abs, $ord, $direction );
				}
			}
			$moves++;
			// printf( "Moved amount: %d\n", $moved_amount );
		} while ( $moved_amount > 0 );

		return [ $moves, $moved_amount ];
	}

	public function spin_cycle() {
		$total_moves = 0;
		$total_amount = 0;

		// North.
		list( $moves, $amount ) = $this->tilt( [ 0, -1 ] );
		$total_amount += $amount;
		$total_moves += $moves;

		// West.
		list( $moves, $amount ) = $this->tilt( [ -1, 0 ] );
		$total_amount += $amount;
		$total_moves += $moves;

		// South.
		list( $moves, $amount ) = $this->tilt( [ 0, 1 ] );
		$total_amount += $amount;
		$total_moves += $moves;

		// East.
		list( $moves, $amount ) = $this->tilt( [ 1, 0 ] );
		$total_amount += $amount;
		$total_moves += $moves;

		if ( 0 === $total_moves ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function move_rock( $abs, $ord, $direction ): int {
		list ( $abs_diff, $ord_diff ) = $direction;

		$element = $this->get_at_position( $abs, $ord );

		if ( 'O' !== $element ) {
			throw new Exception( 'Can not move element ' . $element . ' at (' . $abs . ',' . $ord . ')' );
		}

		try {
			$spot = $this->get_at_position( $abs + $abs_diff, $ord + $ord_diff );
		} catch ( ScopeException $e ) {
			return 0;
		}

		if (
			'#' === $spot
			|| 'O' === $spot
		) {
			return 0;
		}

		if ( '.' === $spot ) {
			$this->set_at_position( $abs, $ord, '.' );
			$this->set_at_position( $abs + $abs_diff, $ord + $ord_diff, 'O' );
			//printf(
			//	"Moved (%d, %d) to (%d, %d), new row is:\n %s\n",
			//	$abs,
			//	$ord,
			//	$abs + $abs_diff,
			//	$ord + $ord_diff,
			//	$this->rows[ $ord ]
			//);
			return 1 + $this->move_rock( $abs + $abs_diff, $ord + $ord_diff, $direction );
		}
	}

	public function get_pressure(): int {
		$height = count( $this->rows );

		$pressure = 0;
		foreach ( $this->rows as $ord => $row ) {
			foreach ( str_split( $row, 1 ) as $abs => $char ) {
				if ( 'O' !== $char ) {
					continue;
				}

				$pressure += $height - $ord;
			}
		}
		return $pressure;
	}

	public function get_at_position( $abs, $ord ): string {
		if ( $abs < 0 ) {
			throw new ScopeException( 'Getting outside possible scope of abscisses: ' . $abs );
		}

		if ( $ord < 0 ) {
			throw new ScopeException( 'Getting outside possible scope of ordinates: ' . $ord );
		}

		if ( ! isset( $this->rows[ $ord ] ) ) {
			throw new ScopeException( 'Getting outside possible scope of ordinates: ' . $ord );
		}

		if ( $abs >= strlen( $this->rows[ $ord ] ) ) {
			throw new ScopeException( 'Getting outside possible scope of abscisses: ' . $abs );
		}

		return substr( $this->rows[ $ord ], $abs, 1 );
	}

	public function set_at_position( $abs, $ord, $element ): void {
		if ( $abs < 0 ) {
			throw new ScopeException( 'Setting outside possible scope of abscisses: ' . $abs );
		}

		if ( $ord < 0 ) {
			throw new ScopeException( 'Setting outside possible scope of ordinates: ' . $ord );
		}

		if ( ! isset( $this->rows[ $ord ] ) ) {
			throw new ScopeException( 'Setting outside possible scope of ordinates: ' . $ord );
		}

		if ( $abs >= strlen( $this->rows[ $ord ] ) ) {
			throw new ScopeException( 'Setting outside possible scope of abscisses: ' . $abs );
		}
		$this->rows[ $ord ] = substr_replace( $this->rows[ $ord ], $element, $abs, 1 );
	}
}

class ScopeException extends Exception {}

$map = new TiltMap( $input );
// $map->print_map();

//$map->tilt( [ 0, -1 ] );
//$map->print_map();

//printf( "Pressure: %d\n", $map->get_pressure() );

$hashmap = [];
$map_copies = [];
$loop_amount = 0;
for( $i = 0; $i < 1000000; $i++ ) {

	$has_moved = $map->spin_cycle();
	if ( 0 === $i % 10000  ) {
		printf( "Processed %d cycles.\n", $i );
	}

	$hash = $map->get_hash();
	if ( isset ( $hashmap[ $hash ] ) ) {
		// printf( "Loop candidate %d:", $i - $hashmap[ $hash ] );
		$loop_amount = $i - $hashmap[ $hash ];
		$remainder = 999999 - $i;
		$tail = $remainder % $loop_amount;
		break;
	} else {
		$hashmap[ $hash ] = $i;
	}

	if ( 0 === $has_moved ) {
		printf( "No movement on cycle: %d\n", $i );
	}
}

for ( $i = 0; $i < $tail; $i++  ) {
	$map->spin_cycle();
}

$map->print_map();
printf( "Pressure: %d\n", $map->get_pressure() );
