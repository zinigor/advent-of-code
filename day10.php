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
						 self::UP    => [ '7', 'F' ],
						 self::RIGHT => [ '7', 'J' ],
						 self::DOWN  => [ 'L', 'J' ],
						 self::LEFT  => [ 'F', 'L' ],
					 ];

	const DIRECTIONS =
							[
								self::UP    => [ 'L', 'J' ],
								self::DOWN  => [ '7', 'F' ],
								self::LEFT  => [ '7', 'J' ],
								self::RIGHT => [ 'F', 'L' ],
							];

	/**
	 * The array of node strings.
	 *
	 * @var array
	 */
	protected array $nodes;

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
				return [ $abs, $ord + 1, self::DOWN ];
			case self::DOWN:
				return [ $abs, $ord - 1, self::UP ];
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

		if ( empty( $current_directions ) ) {
			return [ [ $abs, $ord ] ];
		}

		$possible_dirs = array_diff( [ self::UP, self::DOWN, self::LEFT, self::RIGHT ], [ $from ] );
		foreach ( $possible_dirs as $dir ) {
			list ( $next_abs, $next_ord, $next_from ) = $this->get_adjacent_coordinates( $abs, $ord, $dir );
			$candidate = $this->get_node( $next_abs, $next_ord );
			if ( in_array( $candidate, self::CONNECTORS[ $dir ] ) ) {
				$next = $this->traverse_the_loop( $next_abs, $next_ord, $next_from );
				return [
					[ $abs, $ord ],
					...$next
				];
			}
		}
		return [];
	}
}

$taskmap = new Map( $input );
print_r( $taskmap );
print_r( $taskmap->get_start_node() );
print_r( $taskmap->traverse_the_loop( 88, 129, Map::UP ) );
