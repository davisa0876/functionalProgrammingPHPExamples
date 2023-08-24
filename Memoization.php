<?php

function memoize(callable $func) {
    $cache = [];
    return function(...$args) use ($func, &$cache) {
        $key = serialize($args);
        if (!isset($cache[$key])) {
            $cache[$key] = $func(...$args);
        }
        return $cache[$key];
    };
}

$fibonacci = function($n) use (&$fibonacci) {
    if ($n <= 1) return $n;
    return $fibonacci($n-1) + $fibonacci($n-2);
};

$memoizedFibonacci = memoize($fibonacci);

echo $memoizedFibonacci(10); // Output: 55
