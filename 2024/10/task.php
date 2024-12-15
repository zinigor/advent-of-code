<?php

require 'input.php';

class TopoMap {

	public $map = [];

	public $heights = [];

	public $trailheads = [];

	public $vertical;
	public $horizontal;

	public function __construct( $input ) {
		$this->vertical = sizeof( $input );
		foreach ( $input as $index => $line ) {
			if ( ! isset( $this->horizontal ) ) {
				$this->horizontal = strlen( $line );
			}
			for ( $i = 0; $i < strlen( $line ); $i++ ) {
				$value = intval( substr( $line, $i, 1 ) );
				$this->map[ $index ] ??= [];
				$this->map[ $index ][ $i ] = $value;

				$this->heights[ $value ] ??= [];
				$this->heights[ $value ][] = $index . "," . $i;

				if ( 0 === $value ) {
					$this->trailheads[ $index ] ??= [];
					$this->trailheads[ $index ][] = $i;
				}
			}
		}
	}

	public function get_paths( $start ) {
		$directions = [];

		if ( $start[0] - 1 >= 0 ) { // Top
			$directions[] = ( $start[0] - 1 ) . ',' . $start[1];
		}
		if ( $start[0] + 1 < $this->vertical ) { // Bottom
			$directions[] = ( $start[0] + 1 ) . ',' . $start[1];
		}
		if ( $start[1] - 1 >= 0 ) { // Left
			$directions[] = $start[0] . ',' . ( $start[1] - 1 );
		}
		if ( $start[1] + 1 < $this->horizontal ) { // Right
			$directions[] = $start[0] . ',' . ( $start[1] + 1 );
		}

		return $directions;
	}

	public function find_next( $start ) {
		$directions = $this->get_paths( $start );
		$current_height = $this->map[ $start[0] ][ $start[1]];

		return array_intersect(
			$this->heights[ $current_height + 1 ],
			$directions
		);
	}
}

class Trail {
	public $map;

	public $levels;

	public function __construct( $map ) {
		$this->map = $map;
	}

	public function start( $trailhead ) {
		$height = $this->map->map[ $trailhead[0] ][ $trailhead[1] ];
		$this->levels[ $height ][] = $trailhead;
		if ( 9 === $height ) {
			return;
		}

		foreach ( $this->map->find_next( $trailhead ) as $new_start ) {
			//echo "Going up a level from $height to " . $new_start . PHP_EOL;
			$this->start( explode( ',', $new_start ) );
		}
	}

	public function get_score() {
		$score = 0;
		$seen = [];
		foreach ( $this->levels[ 9 ] as $top ) {
			$seen[ $top[0] ] ??= [];
			if ( ! isset( $seen[ $top[0] ][ $top[1] ] ) ) {
				$seen[ $top[0] ][ $top[1] ] = true;
				$score++;
			}
		}
		return $score;
	}

	public function get_rating() {
		return sizeof( $this->levels[ 9 ] );
	}
}

$trailmap = new TopoMap( $input );
$scores = 0;
$ratings = 0;
foreach( $trailmap->trailheads as $vertical => $horizontals ) {
	foreach ( $horizontals as $horizontal ) {
		$trail = new Trail( $trailmap );
		$trail->start( [ $vertical, $horizontal ] );
		//echo "Starting trail at " . $vertical . ',' . $horizontal . PHP_EOL;
		$scores += $trail->get_score();
		$ratings += $trail->get_rating();
		//echo "Level: " . $trail->get_rating() . PHP_EOL;
	}
}

echo $scores . PHP_EOL;
echo $ratings . PHP_EOL;
