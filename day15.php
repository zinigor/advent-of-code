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

class Box {

    protected array $lenses = [];

    protected array $ids = [];

    public function add_lens( $id, $focal ) {
        if ( $this->has_lens( $id ) ) {
            $this->replace_lens( $id, $focal );
        } else {
            $this->push_lens( $id, $focal );
        }
    }

    public function has_lens( $id ): bool {
        return isset( $this->ids[ $id ] );
    }

    public function remove_lens( $id ): void {

        if ( ! $this->has_lens( $id ) ) {
            throw new Exception( "No such lens with id: " . $id );
        }

        unset( $this->lenses[ $this->ids[ $id ] ] );
        unset( $this->ids[ $id ] );

        // Compacting ids.
        $this->lenses = array_values( $this->lenses );
        $this->generate_ids();
    }

    public function replace_lens( $id, $focal ): void {
        if ( ! $this->has_lens( $id ) ) {
            throw new Exception( "No such lens with id: " . $id );
        }

        $this->lenses[ $this->ids[ $id ] ] = [
            'id' => $id,
            'focal' => $focal
        ];
    }

    public function push_lens( $id, $focal ): void {
        if ( $this->has_lens( $id ) ) {
            throw new Exception( "Lens with such id already added: " . $id );
        }

        array_push(
            $this->lenses,
            [
                'id' => $id,
                'focal' => $focal
            ]
        );

        $this->generate_ids();
    }

    public function generate_ids(): void {
        $this->ids = [];
        foreach ( $this->lenses as $index => $lens ) {
            $this->ids[ $lens['id'] ] = $index;
        }
    }

    /**
     * Adds up the focusing power of all of the lenses.
     * The focusing power of a single lens is the result of multiplying together:
     *
     *      The slot number of the lens within the box: 1 for the first lens, 2 for the second lens, and so on.
     *      The focal length of the lens.
     *
     * @param int $box the number of the box.
     */
    public function get_focus_power( $box ): int {
        $sum = 0;
        foreach ( $this->lenses as $index => $lens ) {
            $sum += $box * ( $index + 1 ) * $lens['focal'];
        }

        return $sum;
    }
}

$parts = explode( ',', $input );
//print_r( $parts );
// print_r( Hasher::hash( $parts[0] ) );

$sum = 0;
$boxes = [];
$lenses = [];
foreach ( $parts as $part ) {
    if ( '=' === $part[-2] ) {
        $focal = $part[-1];
        $label = substr( $part, 0, strlen( $part ) - 2 );
        $box = Hasher::hash( $label );
        printf( "Part: %s\tMarking %s length %d\tBox: %d\n", $part, $label, $focal, $box );

        $boxes[ $box ] ??= new Box();
        $boxes[ $box ]->add_lens( $label, $focal );
    } elseif ( '-' === $part[-1] ) {
        $label = substr( $part, 0, strlen( $part ) - 1 );
        $box = Hasher::hash( $label );
        printf( "Part: %s\tRemoving lens %s\tBox: %d\n", $part, $label, $box );

        $boxes[ $box ] ??= new Box();

        try {
            $boxes[ $box ]->remove_lens( $label, $focal );
        } catch ( Exception $e ) {
            //printf( "No such lens, carrying on.\n" );
        }
    } else {
        throw new Exception ( 'WHF' );
    }
}

$sum = 0;
foreach( $boxes as $index => $box ) {
    $sum += $box->get_focus_power( $index + 1 );
}

printf( "Sum: %d\n", $sum );
//print_r( $boxes );
