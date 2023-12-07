<?php

require './input7.php';

class Hand {

    // A, K, Q, J, T, 9, 8, 7, 6, 5, 4, 3, or 2
    static public $cards = [
        'A' => 14,
        'K' => 13,
        'Q' => 12,
        'J' => 0,
        'T' => 10,
        '9' => 9,
        '8' => 8,
        '7' => 7,
        '6' => 6,
        '5' => 5,
        '4' => 4,
        '3' => 3,
        '2' => 2,
        '1' => 1,
    ];

	const FIVE_KIND = 7;
	const FOUR_KIND = 6;
	const FULL_HOUSE = 5;
	const THREE_KIND = 4;
	const TWO_PAIRS = 3;
	const ONE_PAIR = 2;
	const HIGH_CARD = 1;

	protected String $hand;

	protected int $bid;

	public function __construct( $input ) {
		list( $hand, $bid ) = explode( ' ', $input );

		$this->hand = $hand;
		$this->bid = $bid;
    }

    public function getBid(): string {
        return $this->bid;
    }

    public function getHand(): string {
        return $this->hand;
    }

    public function getMaxType( $cards ) {
        $max = 0;
        foreach ( $cards as $type => $num ) {
            if ( $num > $max ) {
                $max = $num;
                $max_type = $type;
            }
		}
        return $max_type;
    }

	public function getCombo(): int {
		$cards = [];
		foreach ( str_split( $this->hand ) as $card ) {
			$cards[ $card ] ??= 0;
			$cards[ $card ] += 1;
		}

        if (
            isset( $cards[ 'J' ] )
            && 1 !== sizeof( $cards )
        ) {
            $jokers = $cards['J'];
            unset( $cards['J'] );

            $cards[ $this->getMaxType( $cards ) ] += $jokers;
        }

		switch ( sizeof( $cards ) ) {
			case 5:
				return self::HIGH_CARD;
			case 4:
				return self::ONE_PAIR;
			case 3:
				if ( in_array( 3, $cards ) ) {
                    return self::THREE_KIND;
                } else {
                    return self::TWO_PAIRS;
                }
            case 2:
                if ( in_array( 4, $cards ) ) {
                    return self::FOUR_KIND;
                } else {
                    return self::FULL_HOUSE;
                }
			case 1:
				return self::FIVE_KIND;
		}
	}
}

$hands = [];
foreach( $input as $hand_input ) {
	$hand = new Hand( $hand_input );
	$hands[] = $hand;
	//print_r( $hand->getCombo() );
}

usort( $hands, function( $a, $b ) {
    if ( $a->getCombo() > $b->getCombo() ) {
        return 1;
    } elseif( $a->getCombo() < $b->getCombo() ) {
        return -1;
    }

    $hand1 = $a->getHand();
    $hand2 = $b->getHand();

    //print( "Cards are the same rank!" . PHP_EOL );
    //print( $hand1 . PHP_EOL );
    //print( $hand2 . PHP_EOL );
    for( $i = 0; $i < 5; $i++ ) {
        $itha = substr( $hand1, $i, 1 );
        $ithb = substr( $hand2, $i, 1 );
        //print( "Comparing $itha vs $ithb" . PHP_EOL );

        if ( Hand::$cards[ $itha ] > Hand::$cards[ $ithb ] ) {
            return 1;
        } elseif ( Hand::$cards[ $itha ] < Hand::$cards[ $ithb ] ) {
            return -1;
        }
    }
} );

$sum = 0;
foreach( $hands as $index => $hand ) {
    print( $index . ':' );
    print( $hand->getHand() . ':' );
    print( $hand->getCombo() . PHP_EOL );
    $sum += $hand->getBid() * ( $index + 1 );
}
print_r( $sum . PHP_EOL );
