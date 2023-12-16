<?php

require './input13.php';

class MirrorMap {

	public array $rows = [];

	public array $columns = [];

	public array $mirror = [];

	public function __construct( $input ) {
		$rows = explode( "\n", $input );

		foreach ( $rows as $row ) {
			$this->rows[] = $row;

			foreach ( str_split( $row, 1 ) as $index => $char ) {
				$this->columns[ $index ] ??= '';
				$this->columns[ $index ] .= $char;
			}
		}

		//print_r( $this->rows );
		//print_r( $this->columns );

		$horizontal_reflections = [];
		foreach ( $this->rows as $index => $row ) {
			$horizontal_reflections[ $index ] = $this->find_middle( $row );
		}

		$vertical_reflections = [];
		foreach ( $this->columns as $index => $column ) {
			$vertical_reflections[ $index ] = $this->find_middle( $column );
		}

		$horizontal = array_reduce( $horizontal_reflections, array( $this, 'reduce_reflections' ), 0 );
		$vertical = array_reduce( $vertical_reflections, array( $this, 'reduce_reflections' ), 0 );

		$this->mirror = [
			$horizontal[0] ?? null,
			$vertical[0] ?? null,
		];
	}

	public function reduce_reflections( $carry, $item ) {
		if ( 0 === $carry ) {
			return $item;
		}

		$result = [];
		foreach ( $carry as $carry_item ) {
			if ( in_array( $carry_item, $item ) ) {
				$result[] = $carry_item;
			}
		}

		return $result;
	}

	public function find_middle( $row ): array {
		$possibilities = [];
		$length = strlen( $row );
		//printf( "--------------\n%s\n", $row );
		for ( $i = $length % 2; $i < $length; $i += 2 ) {
			for ( $end = 0; $end < 2; $end++ ) {
				//print( "Start: $end; Index: $i\n" );
				if ( $end ) {
					$start_chunk = substr( $row, $i );
				} else {
					$start_chunk = substr( $row, 0, $length - $i );
				}
				$start_chunk_backwards = strrev( $start_chunk );
				//printf( "%s\n", $start_chunk );

				if ( $start_chunk === $start_chunk_backwards ) {
					//printf( "MATCH %f\n", $i + ( strlen( $start_chunk ) / 2 ) );
					$key = $end ?
							 $i + ( strlen( $start_chunk ) / 2 ) :
							 ( strlen( $start_chunk ) / 2 );
					// printf( "Match: \t%s\nIteration: %d, Key: %d\n", $start_chunk, $i, $key);
					$possibilities[] = $key;
				}
			}
		}
		return $possibilities;
	}

	public function get_mirror() {
		return $this->mirror;
	}
}

$sum = 0;
foreach ( explode( "\n\n", $input ) as $block ) {
	$mirrormap = new MirrorMap( $block );
	$map = $mirrormap->get_mirror();
	if ( ! is_null( $map[0] ) ) {
		$sum += $map[0];
	} else {
		$sum += $map[1] * 100;
	}
}

printf("%d\n", $sum);
