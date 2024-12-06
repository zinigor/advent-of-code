<?php

require 'input.php';

class Sorter {

	public $before = [];

	public $after = [];

	public function __construct( $rules ) {
		foreach ( $rules as $value ) {
			list( $before, $after ) = explode( '|', $value );

			$this->before[ $before ] ??= [];
			$this->before[ $before ][] = $after;

			$this->after[ $after ] ??= [];
			$this->after[ $after ][] = $before;
		}
	}

	public function is_ordered( $input ) {
		$seen = [];
		foreach( $input as $index => $item ) {
			// echo "Checking " . $item . " from index " . $index . PHP_EOL;
			if ( isset( $this->before[ $item ] ) ) {
				foreach ( $this->before[ $item ] as $after ) {
					if ( isset( $seen[ $after ] ) ) {
						// echo "Not ordered because item " . $item . " should go before " . $after . PHP_EOL;
						return false;
					}
				}
			}
			$seen[ $item ] = true;
		}
		return true;
	}

	public function get_middle( &$input ) {
		$length = sizeof( $input );
		$index = floor( $length / 2 );
		return $input[ $index ];
	}

	public function order( &$input ) {
		usort( $input, array( $this, 'usorter' ) );
	}

	public function usorter( $a, $b ) {

			$before_a = $this->after[ $a ] ?? [];
			$after_a = $this->before[ $a ] ?? [];
			$before_b = $this->after[ $b ] ?? [];
			$after_b = $this->before[ $b ] ?? [];

			if ( in_array( $a, $before_b ) ) {
				return -1;
			}

			if ( in_array( $b, $after_a ) ) {
				return -1;
			}

			if ( in_array( $b, $before_a ) ) {
				return 1;
			}

			if ( in_array( $a, $after_b ) ) {
				return 1;
			}
			return 0;
	}
}

$sorter = new Sorter( $input_rules );

// print_r( $sorter->before );

$sum = 0;
$ordered_sum = 0;
$count = 0;
foreach( $input_updates as $index => $update ) {
	if ( $sorter->is_ordered( $update ) ) {
		// echo "Index: " . $index . ". Sorted: yes" . PHP_EOL;
		$count++;
		$sum += $sorter->get_middle( $update );
	} else {
		echo join( ' ', $update ) . PHP_EOL;
		$sorter->order( $update );
		$ordered_sum += $sorter->get_middle( $update );
		echo join( ' ', $update ) . PHP_EOL;
	}
}

echo "Sum: $sum" . PHP_EOL;
echo "Sum of corrected: $ordered_sum" . PHP_EOL;
