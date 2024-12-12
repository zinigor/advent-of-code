<?php

require_once 'input.php';

class Mapper {
	public $towers;
	public $antinodes;
	public $vertical;
	public $horizontal;

	public function __construct( $input ) {
		$this->vertical = sizeof( $input );
		echo "Vertical bounds: " . $this->vertical . PHP_EOL;
		foreach( $input as $index => $line ) {
			if ( !isset ( $this->horizontal ) ) {
				$this->horizontal = strlen( $line );
				echo "Horizontal bounds: " . $this->horizontal . PHP_EOL;
			}

			for ( $i = 0; $i < strlen( $line ); $i++ ) {
				$digit = substr( $line, $i, 1 );

				if ( '.' === $digit ) {
					continue;
				}

				$this->towers[ $digit ][] = [ $index, $i ];
			}
		}
	}

	public function calculate_antinodes() {
		foreach( $this->towers as $type => $coords ) {
			foreach ( $coords as $tuple ) {
				foreach ( $coords as $other ) {
					list( $y, $x ) = $this->get_distance( $tuple, $other );

					if ( 0 === $x && 0 === $y ) {
						continue;
					}

					$antinode = [
						$other[0] + $y,
						$other[1] + $x,
					];

					if (
						$antinode[0] < 0
						|| $antinode[0] > $this->vertical
						|| $antinode[1] < 0
						|| $antinode[1] > $this->horizontal
					) {
						printf(
							"Antinode of type " . $type . " at (%d,%d) is out of bounds " . PHP_EOL,
							$antinode[1], $antinode[0]
							);
						continue;
					}

					$this->antinodes[ $type ][] = $antinode;
				}
			}
		}
	}

	public function get_distance( $first, $next) {
		return [
			$next[0] - $first[0],
			$next[1] - $first[1],
		];
	}
}

$mapper = new Mapper( $input );
$mapper->calculate_antinodes();
// var_dump( $mapper );
// var_dump( $mapper->antinodes );

$count = 0;
$seen = [];
foreach ( $mapper->antinodes as $type => $nodes ) {
	foreach ( $nodes as $node ) {
		if ( ! isset( $seen[ $node[0] ][ $node[1] ] ) ) {
			$seen[ $node[0] ][ $node[1] ] = $type;
			$count++;
		} else {
			echo "Node " . $node[0] . ':' . $node[1] . " already seen" . PHP_EOL ;
		}
	}
}
echo "Total count: " . $count . PHP_EOL;

for( $i = 0; $i < $mapper->vertical; $i++ ) {
	for ( $j = 0; $j < $mapper->horizontal; $j++ ) {
		if ( isset( $seen[ $i ][ $j ] ) ) {
			echo strtolower( $seen[ $i ][ $j ] );
			continue;
		}
		echo '.';
	}
	echo PHP_EOL;
}
