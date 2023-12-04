<?php

require './input3.php';

class Raster {

	protected Array $lines = [];

	protected Int $abs = 0;

	protected Int $ord = 0;

	protected Array $entities = [];

	public function __construct( $input ) {
		$this->lines = $input;
		$this->abs = strlen( $input[0] );
		$this->ord = sizeof( $input );

		foreach ( $this->lines as $j => $line ) {
			for ( $i = 0; $i < $this->abs; $i++ ) {
				$fragment = substr( $line, $i, 1 );

				if (
					'.' === $fragment
					|| ! is_numeric( $fragment )
				) {
					continue;
				}

				$this->assignEntity( $i, $j, $fragment );
			}
		}

		// Figuring out adjacency.
		$value = 0;
		foreach ( $this->lines as $j => $line ) {
			for ( $i = 0; $i < $this->abs; $i++ ) {
				$fragment = substr( $line, $i, 1 );

				if (
					'.' === $fragment
					|| is_numeric( $fragment )
				) {
					continue;
				}

				if ( '*' !== $fragment ) {
					continue;
				}
					
				$values = $this->getAdjEntities( $i, $j );

				if ( 2 !== sizeof( $values ) ) {
					continue;
				}
				
				$value += $values[0] * $values[1];
			}
		}

		/* print_r(
			array_reduce(
				$values, function ($carry, $item) {
					$carry += $item;
					return $carry;
				}
			)
			);*/
		///		print_r( $values );
		print_r( $value );
	}

	public function assignEntity( $abs, $ord, $fragment ) {
		if ( $this->hasEntity( $abs - 1, $ord ) ) {

			$this->entities[ $abs ][ $ord ] = $this->assignEntity(
				$abs - 1,
				$ord,
				$fragment
			);
			return $this->entities[ $abs ][ $ord ];
		}

		if ( $this->hasEntity( $abs, $ord ) ){

			$this->entities[ $abs ][ $ord ] .= $fragment;
		} else {
			
			if ( ! isset( $this->entities[ $abs ] ) ) {
				$this->entities[ $abs ] = [];
			}

			$this->entities[ $abs ][ $ord ] = $fragment;
		}

		return $this->entities[ $abs ][ $ord ];
	}

	public function hasEntity( $abs, $ord ) {
		if (
			$abs < 0
			|| $ord < 0
			|| $abs >= $this->abs
			|| $ord >= $this->ord
		) {
			return false;
		}

		if ( ! isset( $this->entities[ $abs ] ) ) {
			return false;
		}

		if ( isset( $this->entities[ $abs ][ $ord ] ) ) {
			return true;
		}

		return false;
	}

	public function getEntity( $abs, $ord ) {
		if ( $this->hasEntity( $abs, $ord ) ) {
			return $this->entities[ $abs ][ $ord ];
		}
		return null;
	}

	public function getAdjEntities( $abs, $ord ) {
		$result = [];

		for ( $i = $abs - 1; $i <= $abs + 1; $i++ ) {
			for ( $j = $ord - 1; $j <= $ord + 1; $j++ ) {
				$result[] = $this->getEntity( $i, $j );
			}
		}

		return array_values( array_filter( array_unique( $result ) ) );
	}
}

$raster = new Raster( $input );

//print_r( $raster->entities );
