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

	public function tilt( $direction ) {
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
			printf( "Moved amount: %d\n", $moved_amount );
		} while ( $moved_amount > 0 );
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
$map->print_map();

$map->tilt( [ 0, -1 ] );
$map->print_map();
