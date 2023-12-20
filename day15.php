<?php
//declare( encoding = 'ASCII' );

require './input15.php';

class Hasher {
    static public function produce( $string ) {

    }

    /**
     * Determine the ASCII code for the current character of the string.
     * Increase the current value by the ASCII code you just determined.
     * Set the current value to itself multiplied by 17.
     * Set the current value to the remainder of dividing itself by 256.
     *
     * @param string $part the string part to be hashed.
     * @param int $initial (optional) the current hash state.
     * @return int the hash value.
     */
    static public function hash( string $part, int $initial = 0 ): int {
        $length = strlen( $part );

        $initial += ord( $part[0] );
        $initial *= 17;
        $initial = $initial % 256;
        
        if ( 1 === $length ) {
            return $initial; 
        } else {
            return self::hash( substr( $part, 1 ), $initial );
        }
    }
}

$parts = explode( ',', $input );
//print_r( $parts );
// print_r( Hasher::hash( $parts[0] ) );

$sum = 0;
$boxes = [];
$lenses = [];
foreach ( $parts as $part ) {
    if ( false !== strpos( $part, '=' ) ) {
        $focal = $part[-1];
        $label = substr( $part, 0, strlen( $part ) - 2 );
        printf( "Part: %s\nMarking lens %s as focal length %d\nBox: %d\n", $part, $label, $focal, $hash );
        $box = Hasher::hash( $label );

        $lenses[ $label ] = $focal;
        $boxes[ $box ] ??= [];
        $lenses[ $box ] ??= [];

        if ( false !== ( $index = in_array( $label, $boxes[ $box ] ) ) ) {
            $new_box = [];
            $new_focals = [];
            foreach ( $boxes[ $box ] as $index => $item ) {

            } 
        } else {
            array_unshift( $boxes[ $box ], $label );
            $lenses[ $box ][ 0 ] = $focal;
        }
    } else {

    }
}

printf( "Sum: %d\n", $sum );
print_r( $boxes );
