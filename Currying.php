<?php
function curry(callable $func, int $numArgs) {
    $args = [];
    $currier = function($arg) use (&$args, $func, $numArgs, &$currier) {
        $args[] = $arg;
        if (count($args) >= $numArgs) {
            return $func(...$args);
        }
        return $currier;
    };
    return $currier;
}

$curriedAdd = curry($add, 2);

echo $curriedAdd(2)(3); // Output: 5
