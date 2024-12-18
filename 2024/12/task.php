<?php

require 'input.php';

class GardenMap {

	public $plots;

	public $regions;

	public $vertical;

	public $horizontal;

	public function __construct( $input ) {
		$this->vertical = sizeof( $input );

		foreach ( $input as $index => $line ) {
			if ( ! isset ( $this->horizontal ) ) {
				$this->horizontal = strlen( $line );
			}

			$this->plots[ $index ] = [];
			for ( $i = 0; $i < $this->horizontal; $i++ ) {
				$plant = $line[ $i ];
				$this->plots[ $index ][ $i ] = $plant;

				$this->regions[ $plant ] ??= [];
				$this->regions[ $plant ][] = $index . '|' . $i;
			}
		}

		$this->split_regions();

		foreach ( $this->regions as $plant => $plots ) {
			foreach ( $plots as $key => $plot ) {
				$this->regions[ $plant ][ $key ] = explode( '|', $plot );
			}
		}
	}

	public function split_regions() {
		foreach( $this->regions as $plant => $plots ) {

			$counter = 0;
			while ( ! empty( $this->regions[ $plant ] ) ) {
				$first_plot = array_pop( $this->regions[ $plant ] );

				$contigous_region = [ $first_plot ];
				$this->fill_contiguous_region( $first_plot, $contigous_region );
				$this->regions[ $plant . $counter++ ] = $contigous_region;

				$this->regions[ $plant ] = array_diff(
					$this->regions[ $plant ],
					$contigous_region
				);
			}
		}
	}

	public function fill_contiguous_region( $plot, &$new_region ) {
		$plot = explode( '|', $plot );
		$plant = $this->plots[ $plot[0] ][ $plot[1] ] ?? false;

		if ( false === $plant ) {
			return;
		}

		// echo "Filling for plant " . $plant . " at " . "(" . $plot[0] . '|' . $plot[1] . ')' . PHP_EOL;

		foreach (
			[
				[ -1, 0 ], // Up
				[ 0, 1 ], // Right
				[ 1, 0 ], // Down
				[ 0, -1 ], // Left
			]
				as $direction
		) {
			$neighbors[] = [ $plot[0] + $direction[0], $plot[1] + $direction[1] ];
		}

		foreach ( $neighbors as $neighbor ) {
			$neighbor_plant = $this->plots[ $neighbor[0] ][ $neighbor[1] ] ?? false;
			$coords = $neighbor[0] . '|' . $neighbor[1];

			// echo "Considering plot at " . $coords . PHP_EOL;
			if ( false === $neighbor_plant ) {
				// echo "No plant here" . PHP_EOL;
				continue;
			}

			if ( in_array( $coords, $new_region ) ) {
				// echo "Already added." . PHP_EOL;
				continue;
			}

			if ( $neighbor_plant !== $plant ) {
				// echo "Neighbor doesn't match." . PHP_EOL;
				continue;
			}

			$new_region[] = $coords;
			$this->fill_contiguous_region( $coords, $new_region );
		}
	}

	public function get_plot_perimeter( $plot ) {
		$neighbors = [];
		$perimeter = 0;

		foreach (
			[
				[ -1, 0 ], // Up
				[ 0, 1 ], // Right
				[ 1, 0 ], // Down
				[ 0, -1 ], // Left
			]
				as $direction
		) {
			$neighbors[] = [ $plot[0] + $direction[0], $plot[1] + $direction[1] ];
		}

		$plant = $this->plots[ $plot[0] ][ $plot[1] ];
		foreach ( $neighbors as $neighbor ) {
			$neighbor_plant = $this->plots[ $neighbor[0] ][ $neighbor[1] ] ?? false;

			if ( $plant !== $neighbor_plant ) {
				$perimeter += 1;
			}
		}

		return $perimeter;
	}

	public function get_region_perimeter( $plant ) {
		$perimeter = 0;
		foreach( $this->regions[ $plant ] as $plot ) {
			$perimeter += $this->get_plot_perimeter( $plot );
		}

		return $perimeter;
	}

	public function get_garden_fence_cost() {
		$cost = 0;
		foreach ( $this->regions as $plant => $plots ) {
			$perimeter = $this->get_region_perimeter( $plant );
			$area = sizeof ( $plots );

			// echo "A perimeter for plant " . $plant . " is " . $perimeter . ". Cost is " . $area . " * " . $perimeter . " = " . ( $area * $perimeter ) . PHP_EOL;

			$cost += $area * $perimeter;
		}

		return $cost;
	}
}

$map = new GardenMap( $input );

echo $map->get_garden_fence_cost() . PHP_EOL;
