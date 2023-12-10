<?php

require './input9.php';

class Sequence {

	protected Array $sequence;

	protected Sequence $differences;

	public function __construct( Array $input ) {
		$this->sequence = $input;

		$diffs = [];
		$length = sizeof( $input );

		$unique = array_unique( $input );

		if (
			1 !== sizeof( $unique )
			||! in_array( 0, $unique, true )
		) {
			for ( $i = 1; $i < $length; $i++ ) {
				$diffs[] = $input[ $i ] - $input[ $i - 1 ];
			}
			$this->differences = new Sequence( $diffs );
		}
	}

	static public function fromString( $string ): Sequence {
		$sequence = explode( ' ', $string );
		return new Sequence( $sequence );
	}

	public function extrapolate( bool $forward = true ): int {
		if( isset( $this->differences ) ) {

			if ( $forward ) {
				return
					$this->sequence[ sizeof( $this->sequence ) - 1 ]
					+ $this->differences->extrapolate();
			} else {
				return
					$this->sequence[ 0 ]
					- $this->differences->extrapolate( false );
			}
		}
		return 0;
	}
}

$sequences = [];
$sum = 0;
$backsum = 0;
foreach ( $input as $item ) {
	$sequences[] = Sequence::fromString( $item );
	//print_r( $sequences[ sizeof( $sequences ) - 1 ] );
	//print( "Extrapolatin: " . $sequences[ sizeof( $sequences ) - 1 ]->extrapolate() . PHP_EOL );
	$sum += $sequences[ sizeof( $sequences ) - 1 ]->extrapolate();
	$backsum += $sequences[ sizeof( $sequences ) - 1 ]->extrapolate( false );
}

print( $sum . PHP_EOL );
print( $backsum . PHP_EOL );
