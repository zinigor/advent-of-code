<?php
// phpcs:disable PEAR, Generic

require 'input.php';

class Report {

	public $levels = [];

	public $dampener = false;

	public $dampened_object;

	public function __construct( $init, $dampener_mode = false ) {
		//echo "Levels: " . $init .  PHP_EOL;
		$this->levels = explode( ' ', $init );
		$this->dampener = $dampener_mode;
	}

	public function has_breaks() {

		// echo "Levels: " . join( '-', $this->levels ) . PHP_EOL;
		foreach ( $this->levels as $index => $level ) {
			if ( ! isset( $previous ) ) {
				// echo "No previous level, current " . $level . PHP_EOL;
				$previous = $level;
				continue;
			}

			// echo "Current level $level ";
			// echo "Previous level $previous " . PHP_EOL;
			if ( $level - $previous > 0 ) {
				// echo "Going up" . PHP_EOL;
				$new_direction = 1;
			} elseif ( $level - $previous < 0 ) {
				// echo "Going down" . PHP_EOL;
				$new_direction = -1;
			} else {
				return true;
			}

			if ( ! isset( $direction ) ) {
				// echo "No previous direction, current " . $new_direction . PHP_EOL;
 				$direction = $new_direction;
			} elseif ( $new_direction !== $direction ) {
				return true;
			}

			$previous = $level;
		}

		return false;
	}

	public function has_spikes() {

		// echo "Levels: " . join( '-', $this->levels ) . PHP_EOL;
		foreach ( $this->levels as $index => $level ) {
			if ( ! isset( $previous ) ) {
				// echo "No previous level, current " . $level . PHP_EOL;
				$previous = $level;
				continue;
			}

			// echo "Current level $level ";
			// echo "Previous level $previous " . PHP_EOL;
			if ( max( $level, $previous) - min( $level, $previous ) > 3 ) {
				return true;
			}

			$previous = $level;
		}

		return false;
	}

	public function is_safe() {
		$is_safe = ! $this->has_breaks() && ! $this->has_spikes();

		if ( ! $is_safe ) {
			for ( $i = 0; $i < sizeof( $this->levels ); $i++ ) {
				$new_levels = array_diff_key(
					$this->levels,
					array( $i => 1 )
				);

				$report = new Report( join( ' ', $new_levels ) );

				if ( ! $report->has_breaks() && ! $report->has_spikes() ) {
					return true;
				}
			}
		}

		return $is_safe;
	}
}

$safe_count = 0;
foreach ( $input as $data ) {
	$report = new Report( $data );

	//$breaks = $report->has_breaks();
	//$spikes = $report->has_spikes();
	//echo "Report $data: " . PHP_EOL;
	// echo "----------------" . PHP_EOL;
	$is_safe = $report->is_safe();
	//echo "Has breaks: " . ( $breaks ? 'yes' : 'no' )  . PHP_EOL;
	//echo "Has spikes: " . ( $spikes ? 'yes' : 'no' )  . PHP_EOL;
	// echo "Is safe: " . ( $is_safe ? 'yes' : 'no' ) . PHP_EOL;

	if ( $is_safe ) {
		// echo "Is safe!" . PHP_EOL;
		$safe_count++;
	}
}
echo PHP_EOL . $safe_count . PHP_EOL;
