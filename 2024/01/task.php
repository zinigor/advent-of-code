<?php

require 'input.php';

//$input1 = $test_input1;
//$input2 = $test_input2;

sort( $input1, SORT_NUMERIC );
sort( $input2, SORT_NUMERIC );

//var_dump( $input1[0] );
//var_dump( $input2[0] );

for( $i = 0; $i < 10; $i++ ) {
	//echo "$i: " . $input1[ $i ] . " " . $input2[ $i ] . PHP_EOL;
}

$difference = 0;
foreach( $input1 as $key => $value ) {
//	$difference += max( $input2[ $key ], $value ) - min( $input2[ $key ], $value );
}

//echo $difference;

$key = 0;
$count = 0;
$similarity = 0;
$input3 = array();

foreach ( $input2 as $entry ) {
	$input3[ $entry ] ??= 0;
	$input3[ $entry ]++;
}

foreach ( $input1 as $entry ) {
	if ( isset ( $input3[ $entry ] ) ) {
		printf ( "Number %d appears %d times." . PHP_EOL, $entry, $input3[ $entry ] );
	}
	$similarity += $entry * ( $input3[ $entry ] ?? 0 );
}

printf( PHP_EOL . "%f", $similarity );
