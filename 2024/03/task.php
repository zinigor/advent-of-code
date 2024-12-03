<?php

require 'input.php';

$new_data = '';

$doables = explode( 'do()', $input );
foreach( $doables as $doable ) {
	list( $actual, ) = explode( 'don\'t()', $doable );
	$new_data .= $actual;
}

$input = $new_data;
preg_match_all( '/mul\(\d+,\d+\)/', $input, $matches );

$result = 0;
foreach( $matches[0] as $match ) {
	list( $first, $second ) = explode( ',', substr( $match, 4, -1 ) );

	$result += $first * $second;
}
var_dump( $result );
