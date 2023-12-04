<?php

require './input2.php';

$sum = 0;
$sumPower = 0;
foreach ( $input as $item ) {
  //  print( $item . PHP_EOL );
  list ( $game, $draws ) = explode( ':', $item );
  $draws = explode( ';', $draws );
  $game = new Game( $game );
  foreach ( $draws as $draw ) {
    $processedDraw = new Draw();
    $processedDraw->addColors( explode( ',', $draw ) );
    $game->addDraw( $processedDraw );
  }
  printf(
	 "Game %d is possible: %s" . PHP_EOL,
	 $game->getId(),
	 $game->isPossible() ? 'yes' : 'no'
	 );
  printf(
	 "Game %d power is: %d" . PHP_EOL,
	 $game->getId(),
	 $game->getMinimumPower()
	 );

  if ( $game->isPossible() ) {
    $sum += $game->getId();
  }
  $sumPower += $game->getMinimumPower();
}
print( $sum . PHP_EOL );
print( $sumPower . PHP_EOL  );

class Game {

  protected String $name;

  protected Array $draws = [];

  protected Array $parameters =
    [
     'red' => 12,
     'green' => 13,
     'blue' => 14,
     ];

  protected Array $minimals =
    [
     'red' => 0,
     'green' => 0,
     'blue' => 0,
     ];

  public function __construct( String $name ) {
    $this->name = $name;
  }

  public function getId() {
    list ( , $id ) = explode( ' ', trim( $this->name ) );
    return $id;
  }

  public function addDraw( Draw $item ) {
    $this->draws[] = $item;

    foreach( $this->minimals as $name => $minimum ) {
      if ( $item->getCount( $name ) > $minimum ) {
	$this->minimals[$name] = $item->getCount( $name );
      }
    }
  }

  public function isPossible() : bool {
    foreach ( $this->parameters as $name => $maximum ) {
      foreach ( $this->draws as $draw ) {
	if ( $draw->getCount( $name ) > $maximum ) {
	  return false;
	}
      }
    }
    return true;
  }

  public function getMinimumPower(){
    $power = 1;
    foreach ( $this->minimals as $value ) {
      $power *= $value;
    }
    return $power;
  }
};

class Draw {

  protected Array $colors = [];

  public function addColors( Array $colors ) {
    foreach ( $colors as $color ) {
      list( $count, $name ) = explode( ' ', trim( $color ) );
      $this->colors[$name] = (int) $count;
    }
  }

  public function getCount( String $name ) {
    return $this->colors[$name] ?? 0;
  }
}
