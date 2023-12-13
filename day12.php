<?php

require './input12.php';

class Picker {

	protected string $springs;

	protected string $counts;

	protected int $mask;

	protected int $count;

	public function __construct( $input ) {
		list( $springs, $counts ) = explode( ' ', $input );

		$this->springs = implode(
			'?',
			[
				$springs,
				$springs,
				$springs,
				$springs,
				$springs,
			]
		);
		$this->counts = implode(
			',',
			[
				$counts,
				$counts,
				$counts,
				$counts,
				$counts,
			]
		);

		$this->mask = intval(
			implode(
				'',
				array_fill( 0, substr_count( $this->springs, '?' ), '1' )
			),
			2
		);

		$this->count = substr_count( $this->springs, '?' );


		//printf( "%b" . PHP_EOL, $this->mask );
		//printf( "%b" . PHP_EOL, $this->mask & intval( "1111", 2 ) );
	}

	public function get_matches() {
		$matches = 0;
		do {
			$counts = $this->get_counts(
				$this->get_springs()
			);
			if ( $counts === $this->counts ) {
				$matches++;
			}
		} while ( $this->rotate_mask() );

		return $matches;
	}

	public function get_counts( $springs) {
		$counts = [];
		$count = 0;
		foreach ( str_split( $springs, 1 ) as $char ) {
			if ( '#' === $char ) {
				$count++;
			} elseif ( '.' === $char && $count > 0 ) {
				$counts[]= $count;
				$count = 0;
			}
		}
		if ( $count > 0 ) {
			$counts[] = $count;
		}

		return implode( ',', $counts );
	}

	public function get_springs() {

		$springs = $this->springs;

		$offset = 0;
		//printf( "%s\n", $springs );
		for ( $i = $this->count - 1; $i >= 0; $i-- ) {
			$position = strpos( $springs, '?', $offset );
			$offset = $position + 1;
			$bit = pow( 2, $i );
			//printf( "%b\n", $bit );
			//printf( "%b\n", $this->mask );
			//printf( "%b\n", $this->mask & $bit );

			if ( $this->mask & $bit ) {
				$replacement = '.';
			} else {
				$replacement = '#';
			}
			//printf( "%s\n", $replacement );
			$springs = substr_replace( $springs, $replacement, $position, 1 );
		}
		// printf( "%s\n", $springs );
		return $springs;
	}

	public function rotate_mask() {
		if ( 0 === $this->mask ) {
			return false;
		}
		$this->mask -= 1;
		return true;
	}
}
$matches = 0;
printf( "Doing: " );
foreach( $input as $key => $item ) {
	printf( "%d", $key );
	$picker = new Picker( $item );
	$springs = $picker->get_springs();
	$counts = $picker->get_counts( $springs );
	//print_r( $counts );
	$matches += $picker->get_matches();
	print( chr(8) );
}

printf( "\n%d\n", $matches );
