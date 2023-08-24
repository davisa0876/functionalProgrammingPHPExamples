<?php
function bind(callable $func, ...$args) {
    return function(...$remainingArgs) use ($func, $args) {
        return $func(...array_merge($args, $remainingArgs));
    };
}

$add = function($x, $y) {
    return $x + $y;
};

$addFive = bind($add, 5);
echo $addFive(3); // Output: 8
