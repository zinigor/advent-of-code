<?php // phpcs:ignore
/**
 * Day 10 entry.
 */

require './input10.php';

/**
 * Let's map this thing.
 */
class Map {

	const UP    = 0;
	const RIGHT = 1;
	const DOWN  = 2;
	const LEFT  = 3;

	const CONNECTORS =
					 [
						 self::UP    => [ '7', 'F', '|' ],
						 self::RIGHT => [ '7', 'J', '-' ],
						 self::DOWN  => [ 'L', 'J', '|' ],
						 self::LEFT  => [ 'F', 'L', '-' ],
					 ];

	const DIRECTIONS =
					 [
						 self::UP    => [ 'L', 'J', '|' ],
						 self::DOWN  => [ '7', 'F', '|' ],
						 self::LEFT  => [ '7', 'J', '-' ],
						 self::RIGHT => [ 'F', 'L', '-' ],
					 ];

	const AVAILABLE_DIRECTIONS = [
		'L' => [ self::UP, self::RIGHT ],
		'J' => [ self::UP, self::LEFT ],
		'7' => [ self::DOWN, self::LEFT ],
		'F' => [ self::DOWN, self::RIGHT ],
		'-' => [ self::LEFT, self::RIGHT ],
		'|' => [ self::UP, self::DOWN ],
	];

	/**
	 * The array of node strings.
	 *
	 * @var array
	 */
	protected array $nodes;

	/**
	 * The current loop sorted by ord and abs.
	 *
	 * @var array
	 */
	protected array $current_loop;

	protected array $current_poke;

	/**
	 * The max abscissa of the map.
	 *
	 * @var int
	 */
	protected int $abs;

	/**
	 * The max ordinata of the map.
	 *
	 * @var int
	 */
	protected int $ord;

	/**
	 * Constructing the map using the task input.
	 *
	 * @param array $input the task input.
	 */
	public function __construct( $input ) {
		$this->nodes = $input;
		$this->abs   = strlen( $input[0] );
		$this->ord   = count( array_keys( $input ) );
	}

	/**
	 * Finds and returns the starting node of the map.
	 *
	 * @return array the array with two entries - x and y of the starting node.
	 */
	public function get_start_node() {
		foreach ( $this->nodes as $ord => $row ) {
			$abs = strpos( $row, 'S' );
			if ( false !== $abs ) {
				return [ $abs, $ord ];
			}
		}
	}

	/**
	 * Returns a specified node value.
	 *
	 * @param int $abs the abscissa of the node.
	 * @param int $ord the ordinata of the node.
	 * @return string node value.
	 */
	public function get_node( int $abs, int $ord ) {
		return substr( $this->nodes[ $ord ], $abs, 1 );
	}

	/**
	 * Returns a specified node's directions.
	 *
	 * @param int $abs the abscissa of the node.
	 * @param int $ord the ordinata of the node.
	 * @return array node directions.
	 */
	public function get_node_directions( int $abs, int $ord ) {
		$node = $this->get_node( $abs, $ord );
		$dirs = [];

		if ( 'S' === $node ) {
			return [];
		}

		foreach( self::DIRECTIONS as $direction => $values ) {
			if ( false !== in_array( $node, $values ) ) {
				$dirs[]= $direction;
			}
		}

		return $dirs;
	}

	/**
	 * Returns a list of x, y, and a direction identifier for the specified node
	 * and adjacency identifier.
	 *
	 * @param int $abs the abscissa of the current step.
	 * @param int $ord the ordinata of the current step.
	 * @param int $direction the next direction.
	 * @return array list of x, y, dir
	 */
	public function get_adjacent_coordinates( int $abs, int $ord, int $direction ) {
		switch ( $direction ) {
			case self::UP:
				return [ $abs, $ord - 1, self::DOWN ];
			case self::DOWN:
				return [ $abs, $ord + 1, self::UP ];
			case self::LEFT:
				return [ $abs - 1, $ord, self::RIGHT ];
			case self::RIGHT:
				return [ $abs + 1, $ord, self::LEFT ];
		}
	}

	/**
	 * Traverse the loop starting with input and build the sequence.
	 *
	 * @param int $abs the abscissa of the current step.
	 * @param int $ord the ordinata of the current step.
	 * @param int $from the previous direction.
	 */
	public function traverse_the_loop( int $abs, int $ord, int $from ): array {
		$current_directions = $this->get_node_directions( $abs, $ord );

		//print( "Current from: $from" . PHP_EOL );
		//print( "Current directions:" . PHP_EOL );
		//print_r( $current_directions );
		if ( empty( $current_directions ) ) {
			return [ [ $abs, $ord, $from ] ];
		}

		$possible_dirs = self::AVAILABLE_DIRECTIONS[ $this->get_node( $abs, $ord ) ];
		$possible_dirs = array_diff( $possible_dirs, [ $from ] );
		//print( "Possible dirs:" . PHP_EOL );
		//print_r( $possible_dirs );
		foreach ( $possible_dirs as $dir ) {
			list ( $next_abs, $next_ord, $next_from ) = $this->get_adjacent_coordinates( $abs, $ord, $dir );
			$candidate = $this->get_node( $next_abs, $next_ord );
			// print( "Looking at candidate $candidate at $dir" . PHP_EOL );
			if ( in_array( $candidate, self::CONNECTORS[ $dir ] ) ) {
				// print( "Found dir " . $dir . " at $next_abs:$next_ord"  . PHP_EOL );
				$next = $this->traverse_the_loop( $next_abs, $next_ord, $next_from );
				return [
					[ $abs, $ord, $from ],
					...$next
				];
			}
		}
		return [];
	}

	public function count_inside() {
		$loop = $this->traverse_the_loop( 88, 129, Map::UP );
		$loop[] = [ 88, 128 ];

		$inside = 0;
		foreach ( $loop as $node ) {
			if ( ! isset( $this->current_loop[ $node[1] ] ) ) {
				$this->current_loop[ $node[1] ] = [];
			}
			$this->current_loop[ $node[1] ][ $node[0] ] = 1;
		}

		for ( $j = 0; $j < $this->ord; $j++ ) {
			$is_inside = false;
			$is_border = false;
			$is_outside = true;

			$opening = null;
			for ( $i = 0; $i < $this->abs; $i++ ) {
				$is_loop = isset( $this->current_loop[ $j ][ $i ] );
				$element = $this->get_node( $i, $j );

				$is_loop ? print( $element ) : print( '.' );
				if (
					$is_loop
					&& ! is_null ( $opening )
					&& (
						'7' === $element
						|| 'J' === $element
					)
				) {
					$opening = null;
					if (
						'7' === $element && 'F' === $opening
						|| 'J' === $element && 'L' === $opening
					) {
						continue;
					}

					if (
						'7' === $element && 'L' === $opening
						|| 'J' === $element && 'F' === $opening
					) {
						$element = '|';
					}
				}

				if (
					$is_loop
					&& (
						'|' === $element
						|| 'S' === $element
					)
				) {
					//print( $element );

					$is_border = true;
					$is_inside = ! $is_inside;
					printf( chr(8) . "%s", $is_inside ? '1' : '0' );
				} elseif(
					$is_loop
					&& (
						'F' === $element
						|| 'L' === $element
					)
				) {
					$opening = $element;
					//print( $element );
					continue;
				} elseif ( $is_loop && '-' === $element ) {
					//print( $element );
					$is_border = true;
				} else {
					//$is_inside ? print( '^' ) : print( '.' );
					$is_border = false;
				}

				if ( ! $is_border && $is_inside ) {
					$inside++;
				}
			}
			print ':' . $inside . PHP_EOL;
		}
		print_r( $inside );
	}

	public function etch() {
		$loop = $this->traverse_the_loop( 88, 129, Map::UP );
		$loop[] = [ 88, 128, Map::UP ];
		$loop[] = [ 88, 127, Map::UP ];

		foreach ( $loop as $node ) {
			if ( ! isset( $this->current_loop[ $node[1] ] ) ) {
				$this->current_loop[ $node[1] ] = [];
			}
			$this->current_loop[ $node[1] ][ $node[0] ] = 1;

		}

		foreach ( $loop as $node ) {
			list( $nodeabs, $nodeord, $nodefrom ) = $node;

			// Going right.
			switch( $nodefrom ) {
				case self::UP:
					// Poking to the right.
					list( $pokeabs, $pokeord, $pokedir ) = $this->get_adjacent_coordinates( $nodeabs, $nodeord, self::RIGHT );
					break;
				case self::DOWN:
					// Poking to the left.
					list( $pokeabs, $pokeord, $pokedir ) = $this->get_adjacent_coordinates( $nodeabs, $nodeord, self::LEFT );
					break;
				case self::LEFT:
					// Poking up.
					list( $pokeabs, $pokeord, $pokedir ) = $this->get_adjacent_coordinates( $nodeabs, $nodeord, self::UP );
					break;
				case self::RIGHT:
					// Poking down.
					list( $pokeabs, $pokeord, $pokedir ) = $this->get_adjacent_coordinates( $nodeabs, $nodeord, self::DOWN );
					break;
			}
			$this->poke( $pokeabs, $pokeord );
		}

		//$count = $this->poke( 0, 0 );
		//$this->poke( 70, 72 );
		//print PHP_EOL . $count;
		//print PHP_EOL . count ( $loop );
		//print PHP_EOL . ( $this->abs * $this->ord );

		$count = 0;
		for ( $j = 0; $j < $this->ord; $j++ ) {
			print $j . ':';
			for ( $i = 0; $i < $this->abs; $i++ ) {
				$is_poke = isset( $this->current_poke[ $j ][ $i ] );
				$is_loop = isset( $this->current_loop[ $j ][ $i ] );
				if ( $is_loop ) {
					$nodesymbol = $this->get_node( $i, $j);
					switch ( $nodesymbol ) {
						case 'L':
							$nodesymbol = "\u{231E}";
							break;
						case 'F':
							$nodesymbol = "\u{231C}";
							break;
						case '7':
							$nodesymbol = "\u{231D}";
							break;
						case 'J';
							$nodesymbol = "\u{231F}";
							break;

						default:
					} 
					print( $nodesymbol );
				} elseif ( $is_poke ) {
					$count++;
					print( '*' );
				} else {
					print( '.' );
				}
			}
			print PHP_EOL;
		}
		print PHP_EOL . $count . PHP_EOL;
	}

	public function poke( $abs, $ord ) {
		if (
			$abs < 0
			|| $ord < 0
			|| $abs > $this->abs
			|| $ord > $this->ord
		) {
			return 0;
		}

		if ( isset( $this->current_loop[ $ord ][ $abs ] ) ) {
			return 0;
		}

		if ( isset( $this->current_poke[ $ord ][ $abs ] ) ) {
			return 0;
		}

		if ( ! isset( $this->current_poke[ $ord ] ) ) {
			$this->current_poke[ $ord ] = [];
		}
		$this->current_poke[ $ord ][ $abs ] = 1;
		// print ( "poking $abs $ord" );

		return 1 +
			$this->poke( $abs - 1, $ord ) +
			$this->poke( $abs + 1, $ord ) +
			$this->poke( $abs, $ord - 1 ) +
			$this->poke( $abs, $ord + 1 ) +
			$this->poke( $abs - 1, $ord - 1 ) +
			$this->poke( $abs + 1, $ord + 1 ) +
			$this->poke( $abs + 1, $ord - 1 ) +
			$this->poke( $abs - 1, $ord + 1 );
	}
}

$taskmap = new Map( $input );
//print_r( $taskmap );
//print_r( $taskmap->get_start_node() );

//foreach ( $loop as $abs, $ord );
//print_r( $loop );

//$taskmap->etch();
$taskmap->count_inside();
