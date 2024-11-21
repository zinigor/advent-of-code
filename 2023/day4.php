<?php

require './input4.php';

class Card {

    protected int $number;

    protected Array $winners = [];

    protected Array $entries = [];

    protected int $matches = 0;

    public function __construct( String $input ) {
        list( $card, $entry ) = explode( '|', $input );
        list( $number ,$winners ) = explode( ':', $card );
        list( ,$number ) = explode( 'Card', $number );
        $this->number = (int) trim( $number );
        $this->winners = array_filter( explode( ' ', $winners ) );
        $this->entries = array_filter( explode( ' ', $entry ) );
    }

    public function getValue(): int {
        $value = 0;
        foreach( $this->winners as $winner ) {
            if ( in_array( $winner, $this->entries ) ) {
                $this->matches += 1;
                if ( 0 === $value ) {
                    $value = 1;
                } else {
                    $value *= 2;
                }
            }
        }

        return $value;
    }

    public function getMatches(): int {
        $this->getValue();
        return $this->matches;
    }

    public function getNum(): int {
        return $this->number;
    }
}

$cards = array_fill( 1, sizeof($input), 1 );
$value = 0;
foreach ( $input as $card ) {
    $card = new Card( $card );
    $matches = $card->getMatches();
    $number = $card->getNum();
    for ( $j = 0; $j < $cards[ $number ]; $j++ ) {
        for ( $i = 0; $i < $matches; $i++ ) {
            $cards[ $number + $i + 1 ] += 1;
        }
    }

    $value += $card->getValue();
}
print_r( $cards );
$sum = array_reduce( $cards, function( $item, $carry ) {
    return $carry += $item;
} );
print $sum;
//print $value;
