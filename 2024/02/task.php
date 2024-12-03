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
				if ( $this->dampener ) {
					echo "Exiting with dampener on at $level because zero movement" . PHP_EOL;
					return true;
				} elseif ( isset ( $this->dampened_object ) ) {
					return $this->dampened_object->has_breaks();
				} else {

					$dampener_data = array_diff_key( $this->levels, array( $index => $level ) );
					$this->dampened_object = new Report( join( ' ', $dampener_data ), true );
					echo "Activating zero dampener for: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;
					echo "Dampener data: " . join( ' ', $this->dampened_object->levels ) . PHP_EOL;

					return $this->dampened_object->has_breaks();
				}

			}

			if ( ! isset( $direction ) ) {
				// echo "No previous direction, current " . $new_direction . PHP_EOL;
 				$direction = $new_direction;
			} elseif ( $new_direction !== $direction ) {
				if ( $this->dampener ) {
					echo "Exiting with dampener on at $level because diffent direction" . PHP_EOL;
					return true;
				} elseif ( isset ( $this->dampened_object ) ) {
					return $this->dampened_object->has_breaks();
				} else {
					$dampener_data = array_diff_key( $this->levels, array( ( $index - 1 ) => $level ) );
					$left_dampener = new Report( join( ' ', $dampener_data ), true );
					$dampener_data = array_diff_key( $this->levels, array( ( $index ) => $level ) );
					$right_dampener = new Report( join( ' ', $dampener_data ), true );

					$left_turn = $left_dampener->has_breaks();
					$right_turn = $right_dampener->has_breaks();

					if ( ! $left_turn ) {
						$this->dampened_object = $left_dampener;
						echo "Activating direction dampener for: " . join( '-', $this->levels ) . " at $level - 1 ". PHP_EOL;
						echo "Dampener data: " . join( ' ', $left_dampener->levels ) . PHP_EOL;

						return false;
					} elseif ( ! $right_turn ) {
						$this->dampened_object = $right_dampener;
						echo "Activating direction dampener for: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;
						echo "Dampener data: " . join( ' ', $right_dampener->levels ) . PHP_EOL;

						return false;
					}
					echo "Direction dampener didn't help for: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;

					return true;
				}
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
				if ( $this->dampener ) {
					echo "Exiting with dampener on at $level because spike" . PHP_EOL;
					return true;
				} elseif ( isset ( $this->dampened_object ) ) {
					return $this->dampened_object->has_spikes();
				} else {
					$dampener_data = array_diff_key( $this->levels, array( ( $index - 1 ) => $level ) );
					$left_dampener = new Report( join( ' ', $dampener_data ), true );
					$dampener_data = array_diff_key( $this->levels, array( ( $index ) => $level ) );
					$right_dampener = new Report( join( ' ', $dampener_data ), true );

					$left_spike = $left_dampener->has_spikes();
					$right_spike = $right_dampener->has_spikes();

					if ( ! $left_spike ) {
						$this->dampened_object = $left_dampener;
						echo "Activating spike dampener for: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;
						echo "Dampener data: " . join( ' ', $left_dampener->levels ) . PHP_EOL;

						return false;
					} elseif ( ! $right_spike ) {
						$this->dampened_object = $right_dampener;
						echo "Activating spike dampener for: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;
						echo "Dampener data: " . join( ' ', $right_dampener->levels ) . PHP_EOL;

						return false;
					}
					echo "Spike dampener didn't help: " . join( '-', $this->levels ) . " at $level ". PHP_EOL;

					return true;
				}
			}

			$previous = $level;
		}

		return false;
	}

	public function is_safe() {
		return ! $this->has_breaks() && ! $this->has_spikes();
	}
}

$safe_count = 0;
foreach ( $input as $data ) {
	$report = new Report( $data );

	//$breaks = $report->has_breaks();
	//$spikes = $report->has_spikes();
	//echo "Report $data: " . PHP_EOL;
	echo "----------------" . PHP_EOL;
	$is_safe = $report->is_safe();
	//echo "Has breaks: " . ( $breaks ? 'yes' : 'no' )  . PHP_EOL;
	//echo "Has spikes: " . ( $spikes ? 'yes' : 'no' )  . PHP_EOL;
	// echo "Is safe: " . ( $is_safe ? 'yes' : 'no' ) . PHP_EOL;

	if ( $is_safe ) {
		echo "Is safe!" . PHP_EOL;
		$safe_count++;
	}
}
echo PHP_EOL . $safe_count . PHP_EOL;
