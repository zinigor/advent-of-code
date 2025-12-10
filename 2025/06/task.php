<?php declare( strict_types=1 );

$file = fopen( __DIR__ . '/input.txt', 'r' );

$lines = [];
while ( $line = fgets( $file ) ) {
    $lines[] = $line;
}
fclose( $file );

$pivot = fopen( __DIR__ . '/pivot.txt', 'w' );

for ( $i = strlen( $lines[0] ) - 1; $i >= 0; $i-- ) {
    $line = $lines[0][$i]
        . $lines[1][$i]
        . $lines[2][$i]
        . $lines[3][$i]
        . $lines[4][$i] . PHP_EOL;

    fwrite( $pivot, $line );
}
fclose( $pivot );

$first_operand  = array_values( array_filter( explode( ' ', rtrim( $lines[0], PHP_EOL ) ) ) );
$second_operand = array_values( array_filter( explode( ' ', rtrim( $lines[1], PHP_EOL ) ) ) );
$third_operand  = array_values( array_filter( explode( ' ', rtrim( $lines[2], PHP_EOL ) ) ) );
$fourth_operand = array_values( array_filter( explode( ' ', rtrim( $lines[3], PHP_EOL ) ) ) );
$operator       = array_values( array_filter( explode( ' ', rtrim( $lines[4], PHP_EOL ) ) ) );

$sum = 0;
foreach ( $first_operand as $key => $first ) {
    $second    = $second_operand[ $key ];
    $third     = $third_operand[ $key ];
    $fourth    = $fourth_operand[ $key ];
    $operation = $operator[ $key ];

    $sum += match ( $operation ) {
        '+' => $first + $second + $third + $fourth,
        '*' => $first * $second * $third * $fourth,
        '' => throw new \Exception( 'Unhandled operator at ' . $key ),
    };
}
echo $sum . PHP_EOL;

$file = fopen( __DIR__ . '/pivot.txt', 'r' );

$sum = 0;
$operands = [];
while ( $line = fgets( $file ) ) {
    if ( trim( $line ) === '' ) {
        continue;
    }

    if ( false !== strpos( $line, '+' ) ) {
        list( $last_operand, ) = explode( '+', $line );
        $operands[] = intval( $last_operand );

        $sum += array_reduce( $operands, fn( $carry, $oper ) => $carry + $oper, 0 );
        $operands = [];
        continue;
    }

    if ( false !== strpos( $line, '*' ) ) {
        list( $last_operand, ) = explode( '*', $line );
        $operands[] = intval( $last_operand );

        $sum += array_reduce( $operands, fn( $carry, $oper ) => $carry * $oper, 1 );
        $operands = [];
        continue;
    }

    $operands[] = intval( $line );
}
fclose( $file );
echo $sum . PHP_EOL;
