<?php

require './input13.php';

class MirrorMap {

    public array $rows = [];

    public array $columns = [];

    public function __construct( $input ) {
        $rows = explode( "\n", $input );

		foreach ( $rows as $row ) {
			$this->rows[] = $row;

			foreach( str_split( $row, 1 ) as $index => $char ) {
				$this->columns[ $index ] ??= '';
				$this->columns[ $index ] .= $char;
			}
		}

		print_r( $this->rows );

		foreach ( $this->rows as $row ) {
			print_r( $this->find_middle( $row ) );
		}
	}

	public function find_middle( $row ) {
		$length = strlen( $row );
		for ( $i = 0; $i < $length; $i += 2 ) {

			printf( "Checking: %s\n", substr( $row, $i ) );
			// Checking from the left.
			printf(
				"Checking: \n%s vs \n%s\n",
				substr( $row, 0, $length - $i ),
				substr( strrev( $row ), $i )
			);
			if (
				substr( $row, 0, $length - $i ) === substr( strrev( $row ), $i )
			) {
				print "MATCH\n";
				return ( strlen( $row ) - $i ) / 2;
			}

			printf(
				"Checking: \n%s vs \n%s\n",
				substr( $row, $i ),
				substr( strrev( $row ), 0 )
			);
			if ( substr( $row, $i ) === substr( strrev( $row ), 0, $length - $i ) ) {
				return ( strlen( $row) + $i ) / 2;
			}
		}
	}
}

foreach ( explode( "\n\n", $input ) as $block ) {
	new MirrorMap( $block );
    break;
}
