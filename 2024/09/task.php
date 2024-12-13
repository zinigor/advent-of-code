<?php
//phpcs:disable PEAR
//phpcs:disable Generic.WhiteSpace

require_once 'input.php';

class DiskMap {

	public $blocks = [];

	public $files = [];

	public $max_block;

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
		$this->max_block = sizeof( $this->blocks ) - 1;
	}

	public function get_first_empty_block() {
		foreach( $this->blocks as $index => $value ) {
			if ( false === $value ) {
				return $index;
			}
		}

		throw new Exception( "No space left!" );
	}

	public function get_first_contigous_empty_block( $length ) {
		$found = 0;
		foreach( $this->blocks as $index => $value ) {
			if ( false === $value ) {
				$found++;
				if ( $found === $length ) {
					return $index - $length + 1;
				}
			} else {
				$found = 0;
			}
		}

		throw new Exception( "No space left!" );
	}

	public function get_last_non_empty_block() {
		for ( $index = $this->max_block; $index >= 0; $index-- ) {
			if ( false !== $this->blocks[ $index ] ) {
				return $index;
			}
		}
	}

	public function swap( $one, $other ) {
		$first = $this->blocks[ $one ];
		$second = $this->blocks[ $other ];

		if ( false !== $first ) {
			$this->files[ $first ] = [
				$other,
				...array_diff(
					$this->files[ $first ],
					[ $one ]
				)
			];
		}

		if ( false !== $second ) {
			$this->files[ $second ] = [
				$one,
				...array_diff(
					$this->files[ $second ],
					[ $other ]
				)
			];
		}

		$this->blocks[ $one ] = $second;
		$this->blocks[ $other ] = $first;
	}

	public function defragment() {
		$empty = $this->get_first_empty_block();
		$full = $this->get_last_non_empty_block();

		if ( $empty > $full ) {
			return true;
		}

		$this->swap( $empty, $full );

		return $this->defragment();
	}

	public function compact() {
		krsort( $this->files );

		foreach ( $this->files as $id => $blocks ) {
			try {
				$position = $this->get_first_contigous_empty_block(
					sizeof( $blocks )
				);
			} catch ( Exception $e ) {
				continue;
			}

			if (
				$position > $this->get_last_non_empty_block()
				|| $position > $blocks[0]
			) {
				continue;
			}

			for ( $i = 0; $i < sizeof( $blocks ); $i++ ) {
				$this->swap( $blocks[ $i ], $position + $i );
			}
		}
	}

	public function get_checksum() {
		$sum = 0;
		foreach( $this->blocks as $index => $value ) {
			$sum += $index * $value;
		}
		return $sum;
	}
}

$diskmap = new DiskMap( $input );
// var_dump( $diskmap );
//echo $diskmap->get_last_non_empty_block();
//echo $diskmap->get_first_empty_block();
//$diskmap->defragment();
// print_r( $diskmap->blocks );
//echo $diskmap->get_checksum() . PHP_EOL;
//echo $diskmap->get_first_contigous_empty_block( 3 );
$diskmap->compact();
//var_dump( $diskmap->blocks );
echo $diskmap->get_checksum() . PHP_EOL;
