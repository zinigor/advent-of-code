<?php

require 'input.php';

class StoneLine {

	public $stones;

	public function __construct( $input ) {
		$this->stones = explode( ' ', $input );
	}

	public function walk() {
		$new_stones = '';
		foreach ( $this->stones as $stone ) {
			$new_stones .= ' ' . $this->apply_rule( $stone );
		}

		$this->stones = explode( ' ', $new_stones );
	}

	public function apply_rule( $stone ) {
		if ( 0 === intval( $stone ) ) {
			return '1';
		}

		if ( 0 === strlen( $stone ) % 2 ) {
			list( $first, $second ) = str_split( $stone, strlen( $stone ) / 2 );
			$first = intval( $first );
			$second = intval( $second );
			return $first . ' ' . $second;
		}

		return $stone * 2024;
	}
}

$line = new StoneLine( $input );

for ( $i = 0; $i < 6; $i++ ) {
	$line->walk();
	echo join( ' ', $line->stones ). PHP_EOL;
}
