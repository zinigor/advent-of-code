<?php

require 'input.php';

$ltr = $input;
$rtl = array();

$ttb = array();
$btt = array();

$diag = array();
$diag_back = array();
$diag2 = array();
$diag2_back = array();

foreach ( $ltr as $key => $string ) {
	$rtl[ $key ] = strrev( $string );

	for ( $i = 0; $i < strlen( $ltr[0] ); $i++ ) {
		$ttb[ $i ][] = substr( $string, $i, 1 );
	}
	for ( $i = - strlen( $ltr[0]); $i < strlen( $ltr[0] ); $i++ ) {
		if ( $i + $key < 0 ) {
			$diag[ $i ][] = ' ';
		} else {
			$diag[ $i ][] = substr( $string, $i + $key, 1 ) ?? ' ';
		}
	}
	for ( $i = 0; $i < strlen( $ltr[0] ) * 2; $i++ ) {
		if ( $i - $key < 0 ) {
			$diag2[ $i ][] = ' ';
		} else {
			$diag2[ $i ][] = substr( $string, $i - $key, 1 ) ?? ' ';
		}
	}
}

foreach ( $ttb as $key => $array ) {
	$ttb[ $key ] = join( '', $array );
	$btt[ $key ] = strrev( $ttb[ $key ] );
}

foreach ( $diag as $key => $array ) {
	$diag[ $key ] = join( '', $array );
	$diag_back[ $key ] = strrev( $diag[ $key ] );
}

foreach ( $diag2 as $key => $array ) {
	$diag2[ $key ] = join( '', $array );
	$diag2_back[ $key ] = strrev( $diag2[ $key ] );
}

//var_dump( $rtl );
//var_dump( $ttb );
//var_dump( $diag );
//var_dump( $diag2 );

$occurences = 0;
foreach ( [ $ltr, $rtl, $ttb, $btt, $diag, $diag_back, $diag2, $diag2_back ]  as $data ) {
	foreach ( $data as $line ) {
		$offset = 0;
		while( false !== ( $offset = strpos( $line, 'XMAS', $offset ) ) ) {
			$offset += 4;
			$occurences++;
		}
	}
}
var_dump( $occurences );

$count = 0;
foreach( $ltr as $y => $string ) {
	for ( $x = 0; $x < strlen( $string ); $x++ ) {
		if ( 'A' === substr( $string, $x, 1 ) ) {

			$lt = isset( $ltr[ $y - 1 ] ) ? substr( $ltr[ $y - 1 ], $x - 1, 1 ) : '';
			$rt = isset( $ltr[ $y - 1 ] ) ? substr( $ltr[ $y - 1 ], $x + 1, 1 ) : '';
			$lb = isset( $ltr[ $y + 1 ] ) ? substr( $ltr[ $y + 1 ], $x - 1, 1 ) : '';
			$rb = isset( $ltr[ $y + 1 ] ) ? substr( $ltr[ $y + 1 ], $x + 1, 1 ) : '';

			if (
				'' == $lt
					|| '' == $rt
					|| '' == $lb
					|| '' == $rb
			) {
				//echo '-';
				echo 'a';
				continue;
			}

			$values = [ $lt, $rt, $lb, $rb ];

			if (
				true === in_array( 'X', $values , true )
					|| true === in_array( 'A', $values , true )
			) {
				//echo '*';
				echo 'a';
				continue;
			}

			if ( $lt == $rb || $rt == $lb ) {
				// echo '=';
				echo 'a';
				continue;
			}

			//echo "Values at $x, $y: " . $lt . ' ' . $rt . ' ' . $rb . ' ' . $lb . ' ' . PHP_EOL;
			echo "\033[31m";
			echo 'A';
			echo "\033[0m";
			$count++;
		} else {
			echo strtolower( substr( $string, $x, 1 ) );
		}
	}
	echo PHP_EOL;
}

print_r( $count );
