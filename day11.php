<?php

require './input11.php';

foreach( $input as $index => $line ) {
   print $index. ':' . $line . PHP_EOL;
}

print PHP_EOL;

class GalaxyMap {

	protected array $rows;

	protected array $empty_rows;

	protected array $empty_columns;

	protected array $galaxies;

	protected int $prime;

	public function get_count() {
		return count( $this->galaxies );
	}

	public function __construct( $input ) {
		$this->rows = $input;

		$this->empty_columns = array_combine(
			range( 0, strlen( $input[0] ) - 1 ),
			array_fill( 0, strlen( $input[0] ), 1 )
		);
		foreach ( $this->rows as $index => $item ) {
			$offset = 0;
			$match = false;
			while ( false !== ( $position = strpos( $item, '#', $offset ) ) ) {
				$match  = true;
				$offset = $position + 1;
				unset( $this->empty_columns[ $position ] );
			}

			if ( false === $match ) {
				$this->empty_rows[ $index ] = 1;
			}
		}
		print_r( $this->empty_columns );

		$this->prime = (int) gmp_strval( gmp_nextprime( strlen( $this->rows[0] ) ) );

		$new_rows = [];
		foreach ( $this->rows as $index => $row ) {
			if ( isset ( $this->empty_rows[ $index ] ) ) {
				for( $i = 0; $i < $this->prime; $i++ ) {
					$new_rows[] = $row;
				}
			} else {
				$new_rows[] = $row;
			}
		}
		$this->rows = $new_rows;

		foreach ( $this->rows as $index => $row ) {
			$row_chars = str_split( $row );
			$new_chars = [];
			foreach ( $row_chars as $key => $char ) {
				if ( isset ( $this->empty_columns[ $key ] ) ) {
					$new_chars[] = implode( '', array_fill( 0, $this->prime, '.' ) );
				} else {
					$new_chars[] = $char;
				}
			}
			$this->rows[ $index ] = implode( '', $new_chars );
			print $index . ':' . $this->rows[ $index ] . PHP_EOL;
		}

		$galaxy = 0;
		$this->galaxies = [];
		foreach ( $this->rows as $index => $item ) {
			$offset = 0;
			$match = false;
			while ( false !== ( $position = strpos( $item, '#', $offset ) ) ) {
				$offset = $position + 1;
				$this->galaxies[ $galaxy++ ] = [ $position, $index ];
			}
		}
		//print( count( $this->rows ) . PHP_EOL );
		//print( strlen( $this->rows[0] ) . PHP_EOL );
	}

	public function get_distance( $one, $two ) {
		list( $absone, $ordone ) = $this->galaxies[ $one ];
		list( $abstwo, $ordtwo ) = $this->galaxies[ $two ];

		if ( $one === $two ) return 0;
		$hor_diff = abs( $abstwo - $absone );
		$ver_diff = abs( $ordtwo - $ordone );

		$hor_rem = $hor_diff % $this->prime;
		$ver_rem = $ver_diff % $this->prime;

		$hor_num_primes = ( $hor_diff - $hor_rem ) / $this->prime;
		$ver_num_primes = ( $ver_diff - $ver_rem ) / $this->prime;

		$hor_diff = ( $hor_num_primes * 1000000 ) + $hor_rem;
		$ver_diff = ( $ver_num_primes * 1000000 ) + $ver_rem;

		return $hor_diff + $ver_diff;
	}
}

$gmap = new GalaxyMap( $input );
$sum = 0;
$count = 0;
$mapping = range( 0, $gmap->get_count() - 1 );

do {
	$index = array_shift( $mapping );

	foreach ( $mapping as $pair ) {
		$count++;
		$sum += $gmap->get_distance( $index, $pair );
		//print( "Sum of $index and $pair:" . PHP_EOL );
	}
} while ( count( $mapping ) );

// print_r( $mapping );

print( "The sum: " . $sum . PHP_EOL );
print( "The count: " . $count . PHP_EOL );

//print_r( $gmap );
