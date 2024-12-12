<?php
//phpcs:disable PEAR
//phpcs:disable Generic.WhiteSpace

require_once 'input.php';

class DiskMap {

	public $blocks = [];

	public $files = [];

	public function __construct( $input ) {
		$block_pointer = 0;
		for ( $i = 0; $i < strlen( $input ); $i += 2 ) {
			$file_length = (int) substr( $input, $i, 1 );
			$free_space = (int) substr( $input, $i + 1, 1 );

			for ( $j = 0; $j < $file_length; $j++ ) {
				$file_id = $i / 2;
				$this->blocks[ $block_pointer ] = $file_id;
				$this->files[ $file_id ] ??= [];
				$this->files[ $file_id ][] = $block_pointer;
				$block_pointer++;
			}
			for ( $j = 0; $j < $free_space; $j++ ) {
				$this->blocks[ $block_pointer ] = false;
				$block_pointer++;
			}
		}
	}
}

$diskmap = new DiskMap( $input );
var_dump( $diskmap );
