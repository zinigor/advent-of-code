<?php

require './input5.php';

class Map {
    protected Array $mapping;

    public function addMap( $input ) {
        list( $to, $from, $length ) = explode( ' ', $input );

		//print_r( $length );
        $this->mapping[] = [
            'from' => $from,
            'to' => $to,
            'length' => $length
        ];
    }

    public function mapEntry( int $entry ) {
        $match = -1;
        foreach( $this->mapping as $map ) {
            if ( $entry < $map['from'] ) {
				// printf( "Entry %s is less than %s" . PHP_EOL, $entry, $map['from'] );
                continue;
            }

            $diff = $entry - $map['from'];
            if ( $diff > $map['length'] ) {
				//printf(
				//	"Entry %s is beyond %s than %s" . PHP_EOL,
				//	$entry,
				//	$map['length'],
				//	$map['from']
				//);
                continue;
            }
			//printf(
			//	"Entry %s matches the range starting %s" . PHP_EOL,
			//	$entry,
			//	$map['from']
			//);
			//printf(
			//	"Entry difference is %s" . PHP_EOL,
			//	$diff
			//);

            $match = $map['to'] + $diff;
			break;
        }

        return $match;
    }
}

$mapping_stack = [
    $seed_to_soil_map,
    $soil_to_fertilizer_map,
    $fertilizer_to_water_map,
    // $water_to_light_map,
    //$light_to_temperature_map,
    //$temperature_to_humidity_map,
    $humidity_to_location_map
];

$map_stack = [];

// printf( "Used memory: %s", memory_get_usage() );
foreach( $mapping_stack as $index => $data ) {
    $map_stack[ $index ] = new Map();
    foreach( $data as $entry ) {
        $map_stack[ $index ]->addMap( $entry );
    }
     //print_r( $map_stack[ $index ] );
    //printf( "Used memory: %s", memory_get_usage() );
}

foreach ( $seeds as $seed ) {
    printf( "Seed %s" . PHP_EOL, $seed );
    $position = $seed;
    foreach( $map_stack as $map ) {
        $new_position = $map->mapEntry( $position );
		if ( $new_position > 0 ) {
			$position = $new_position;
		}
        //printf( "Changes to %s" . PHP_EOL, $position );
    }
}

$pairing = [];
foreach ( $seeds as $index => $seed ) {
	if ( $index % 2 ) {
		continue;
	}
	$pairing[ $seed ] = $seeds[$index + 1];
	// print( "Pairing " . $seeds[$i]. "with" . $seeds[$i+1] . PHP_EOL);
}

$minimal = null;
foreach ( $pairing as $seed => $range ) {
	do {
		$position = $seed + $range;;
		foreach ( $map_stack as $map ) {
			$new_position = $map->mapEntry( $position );
			if ( $new_position > 0 ) {
				$position = $new_position;
			}
		}
		if ( is_null( $minimal ) ) {
			$minimal = $position;
		} else {
			$minimal = min( $position, $minimal );
		}
		$range--;
	} while ( $range > $start );
}
print( $minimal . PHP_EOL );
