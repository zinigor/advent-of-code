<?php

require './input8.php';

class Map {
	protected Array $nodes;

	protected String $position;

	public function __construct( $input ) {
		foreach ( $input as $node => $directions ) {
			$this->nodes[ $node ] = $directions;
		}
	}

	public function go( $position ) {
		$this->position = $position;

		return $this->nodes[ $position ];
	}
}

$map = new Map( $nodes );
$directions = $map->go( 'AAA' );
$count = 0;
while (1) {
	foreach ( str_split( $instructions ) as $direction ) {
		$direction = 'R' === $direction ? $directions[1] : $directions[0];
		$directions = $map->go( $direction );
		$count++;
		// print( $count . ':' . $direction . PHP_EOL );
		if ( 'ZZZ' === $direction ) break 2;
	}
}

$maps = [];
$dirs = [];
foreach( $nodes as $input => $directions ) {
	if ( 'A' === substr( $input, 2 ) ) {
		//print( $input . PHP_EOL );
		$new_map = new Map( $nodes );
		$starting_direction = $new_map->go( $input );
		$maps[] = $new_map;
		$dirs[] = $starting_direction;
	}
}

//$maps = [ $maps[5] ];
//$dirs = [ $dirs[5] ];
$maps = [
	$maps[4],
	$maps[0],
	$maps[3],
	$maps[2],
	$maps[1],
	$maps[5],
];
$dirs = [
	$dirs[4],
	$dirs[0],
	$dirs[3],
	$dirs[2],
	$dirs[1],
	$dirs[5],
];

$positions = [];
$instructions = str_split( $instructions );
while (1) {
	foreach ( $instructions  as $direction ) {
		foreach ( $maps as $index => $map ) {
			$next_index = 'R' === $direction ? 1 : 0;
			$next_direction = $dirs[$index][$next_index];
			$positions[$index] = $next_direction;
			$dirs[$index] = $map->go( $next_direction );
		}
		$count++;
		// print( $count . ':' . $direction . PHP_EOL );

		$match = true;
		foreach( $positions as $position ) {
			if ( 2 !== strpos( $position, 'Z', -1 ) ) {
				$match = false;
				break;
			}
		}

		if ( 0 === $count % 100000000 ) { echo $count . PHP_EOL; }
		if ( $match ) {
			print( $count . PHP_EOL );
			print_r( $positions );
			break 2;
		}
	}
}
