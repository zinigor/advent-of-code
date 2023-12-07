<?php

require './input6.php';

class Race {

	protected int $time;

	protected int $record;

	public function __construct( $time, $record ) {
		$this->time = $time;
		$this->record = $record;
	}

	public function getDistance( $priming_time ) {
		$total_time = $this->time - $priming_time;

		// $priming_time also equals speed.
		return $total_time * $priming_time;
	}

	public function winningTimes() {
		$times = [];
		for ( $i = 0; $i <= $this->time; $i++ ) {
			if ( $this->getDistance( $i ) > $this->record ) {
				//print(
				//	"This $i will win! The distance will be "
				//	. $this->getDistance( $i )
				//	. PHP_EOL
				//);
				$times[] = $i;
			}
		}
		return $times;
	}
}

$beats = 1;
foreach ( $time_distance as $record ) {
	list( $time, $record ) = $record;
	$race = new Race( $time, $record );
	$beats *= sizeof( $race->winningTimes() );
}
print $beats . PHP_EOL;

$ultimate_race = new Race ( $time2, $distance2 );
print( sizeof( $ultimate_race->winningTimes() ) . PHP_EOL );
