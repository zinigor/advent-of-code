<?php
// phpcs:disable PEAR, Generic.WhiteSpace

require 'input.php';

class Calculator {

	public $product;

	public $operands;

	static public $string;

	public function __construct( $input ) {
		list( $product, $operands ) = explode( ':', $input );
		$operands = explode( ' ', trim( $operands ) );

		$this->product = $product;
		$this->operands = $operands;
	}

	public function sum() {

		return $this->product;
	}

	public function calculate( &$paths ) {
		$either = false;

		if (
			sizeof ( $this->operands ) === 1
				&& $this->product === $this->operands[0]
		)  {
			$paths = true;
			return true;
		}

		$operand = array_pop( $this->operands );

		$result = $this->do_division( $this->product, $operand );
		if ( empty( $this->operands ) ) {

			if ( 1 === $result ) {
				// echo "We're done on the division " . $result . " = " . $this->product . " / " . $operand . PHP_EOL;
				$either = true;
				$paths[ '*' ] = true;
			}
		} elseif ( false !== $result ) {
			// echo "Dropping into another divison cycle with " . $result . " = " . $this->product . " / " . $operand . PHP_EOL;
			$calculator = new Calculator( $result . ':' . join( ' ', $this->operands ) );
			$paths[ '*' ] = [];
			$either = $calculator->calculate( $paths[ '*' ] ) ? true : $either;
		}

		// echo "Subtracting " . $this->product . " by " . $operand . PHP_EOL;
		$result = $this->do_subtraction( $this->product, $operand );
		//echo "Operand: " . $operand . ". Product: " . $product . "." . PHP_EOL;
		//self::$string = ' + ' . $operand . self::$string;

		if ( empty( $this->operands ) ) {
			if ( 0 === $result ) {
				// echo "We're done on the subtraction " . $result . " = " . $this->product . " / " . $operand . PHP_EOL;
				$either = true;
				$paths[ '+' ] = true;
				return true;
			}
		} elseif ( false !== $result ) {
			// echo "Dropping into another subtraction cycle with " . $result . " = " . $this->product . " - " . $operand . ". Input string: " . $result . ':' . join( ' ', $this->operands ) . PHP_EOL;
			$calculator = new Calculator( $result . ':' . join( ' ', $this->operands ) );
			$paths[ '+' ] = [];
			$either = $calculator->calculate( $paths[ '+' ] ) ? true : $either;
		}

		$result = $this->do_concatenation( $this->product, $operand );
		if ( false !== $result && ! empty( $this->operands ) ) {
			$calculator = new Calculator( $result . ':' . join( ' ', $this->operands ) );
			$paths[ '||' ] = [];
			$either = $calculator->calculate( $paths[ '||' ] ) ? true : $either;
		}

		return $either;
	}

	public function do_concatenation( $product, $operand ) {
		if ( $product !== $operand && str_ends_with( $product, $operand ) ) {
			echo "Because " . $product . " ends with " . $operand . ", returning: " . substr( $product, 0, - strlen( $operand ) ) . PHP_EOL;
			return substr( $product, 0, - strlen( $operand ) );
		}
		return false;
	}

	public function do_division( $product, $divisor ) {
		// echo "Calculating " . $this->product . " dividing by " . $operand . PHP_EOL;
		$product = $product / $divisor;
		//echo "Operand: " . $operand . ". Product: " . $product . "." . PHP_EOL;

		if ( is_float( $product ) ) {
			return false;
			//echo "Does not divide, trying subtraction" . PHP_EOL;
		}

		return $product;
	}

	public function do_subtraction( $product, $subtractor ) {
		// echo "Calculating " . $this->product . " dividing by " . $operand . PHP_EOL;
		$product = $product - $subtractor;
		//echo "Operand: " . $subtractor . ". Product: " . $product . "." . PHP_EOL;

		if ( $product < 0 ) {
			return false;
			//echo "Does not divide, trying subtraction" . PHP_EOL;
		}

		return $product;
	}
}

$sum = 0;
foreach( $input as $line ) {
	 echo $line . PHP_EOL;
	$calculator = new Calculator( $line );
	Calculator::$string = '';
	$paths = [];
	$does_calculate = $calculator->calculate( $paths );

	 printf( "Calculates: %s" . PHP_EOL, $does_calculate ? 'Yeah!': 'Nah.' );

	if( $does_calculate ) {
		$sum += $calculator->sum();
	}
}


echo $sum . PHP_EOL;
