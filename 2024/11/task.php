<?php

require 'input.php';

class RecursiveStoneLine {

	public $count;

	public $stones;

	public static $memo = [];

	public function __construct( $input ) {
		if ( is_array( $input ) ) {
			$this->stones = [ ...$input ];
		} else {
			$this->stones = [ $input ];
		}

		// echo "Input stones: " . join( ' ', $this->stones ) . PHP_EOL;
		$new_stones = [];
		foreach ( $this->stones as $index => $stone ) {
			$this->apply_rule( $stone );

			if ( is_array( $stone ) ) {
				$new_stones = [ ...$new_stones, ...$stone ];
			} else {
				$new_stones = [ ...$new_stones, $stone ];
			}
		}

		$this->stones = $new_stones;
		// echo "Resulting stones: " . join( ' ', $this->stones ) . PHP_EOL;
	}

	public function apply_rule( &$stone ) {

		if ( 0 === intval( $stone ) ) {

			$stone = 1;
			return;
		}

		if ( 0 === strlen( (string) $stone ) % 2 ) {

			list( $first, $second ) = str_split( $stone, strlen( $stone ) / 2 );
			$first = intval( $first );
			$second = intval( $second );
			$stone = [ $first, $second ];

			return;
		}

		$stone *= 2024;
	}

	public function walk( $depth = 0 ) {
		if ( $depth > 73 ) {
			return sizeof( $this->stones );
		}

		$count = 0;
		foreach ( $this->stones as $stone ) {
			if ( isset( self::$memo[ $stone ][ $depth + 1 ] ) ) {
				$count += self::$memo[ $stone ][ $depth + 1 ];
			} else {
				self::$memo[ $stone ] ??= [];

				$line = new RecursiveStoneLine( $stone );
				$increment = $line->walk( $depth + 1 );
				$count += $increment;

				self::$memo[ $stone ][ $depth + 1 ] = $increment;
			}
		}

		return $count;
	}
}
$line = new RecursiveStoneLine( explode( ' ', $input ) );

$count = $line->walk();
echo PHP_EOL . $count . PHP_EOL;
/*
$line = new StoneLine( $input );

for ( $i = 0; $i < 6; $i++ ) {
	//$line->walk();
	if ( $i > 0 ) {
		$source = fopen( 'line' . $i . '.txt', 'r' );
	} else {
		$source = null;
	}
	$handle = fopen( 'line' . ( $i + 1 ) . '.txt', 'w' );
	$line->write( $handle, $source );
	fclose( $handle );
	if ( $source ) {
		fclose( $source );
	}
	echo $i . PHP_EOL;
	// print_r( $line->stones );
}

$count = 0;
array_walk_recursive( $line->stones, function( $item ) use ( &$count ) {
	if ( is_array( $item ) ) {
		return;
	}
	$count++;
} );

echo $count . PHP_EOL;
*/


class StoneLine {

	public $stones;

	public function __construct( $input ) {
		$this->stones = explode( ' ', trim( $input ) );
	}

	public function walk() {
		array_walk_recursive( $this->stones, array( $this, 'apply_rule' ) );
	}

	public function apply_rule( &$stone ) {

		if ( 0 === intval( $stone ) ) {

			$stone = 1;
			return;
		}

		if ( 0 === strlen( (string) $stone ) % 2 ) {

			list( $first, $second ) = str_split( $stone, strlen( $stone ) / 2 );
			$first = intval( $first );
			$second = intval( $second );
			$stone = [ $first, $second ];

			return;
		}

		$stone *= 2024;
	}

	public function write( $file, $source = null ) {
		if ( null === $source ) {
			foreach ( $this->stones as $stone ) {
				$this->apply_rule( $stone );
				if ( is_array( $stone ) ) {
					$stone = join( PHP_EOL, $stone );
				}
				fwrite( $file, $stone . PHP_EOL );
			}
		} else {
			while ( $stone = fscanf( $source, "%d\s")) {
				echo '-------------';
				print_r( $stone );
			}
		}
	}
}
