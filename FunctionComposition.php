<?php

function compose(...$functions) {
    return function($value) use ($functions) {
        return array_reduce(
            array_reverse($functions),
            function($acc, $func) {
                return $func($acc);
            },
            $value
        );
    };
}

$square = function($n) { return $n * $n; };
$double = function($n) { return $n * 2; };

$squareThenDouble = compose($double, $square);
echo $squareThenDouble(4); // Output: 32 (4*4 = 16, 16*2 = 32)
