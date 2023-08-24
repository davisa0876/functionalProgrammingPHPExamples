<?php

// Higher-order function to filter out elements from an array
function filterArray(callable $predicate, array $array): array {
    return array_values(array_filter($array, $predicate));
}

// Higher-order function to map a function over an array
function mapArray(callable $func, array $array): array {
    return array_map($func, $array);
}

// Higher-order function to reduce an array to a single value
function reduceArray(callable $func, array $array, $initial = null) {
    return array_reduce($array, $func, $initial);
}

// Sample array
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Example usage

// Step 1: Filter out even numbers
$isOdd = function($n) {
    return $n % 2 !== 0;
};

$onlyOdd = filterArray($isOdd, $numbers);
print_r($onlyOdd);

// Step 2: Square the remaining numbers
$square = function($n) {  return $n ** 2; };

$squared = mapArray($square, $onlyOdd);
print_r($squared);

// Step 3: Sum the squared numbers
$sum = function($carry, $n) { return $carry + $n;
};

$total = reduceArray($sum, $squared, 0);
print_r($total);

// Compose all steps into one function for reusability
function processNumbers(array $numbers): int {
    global $isOdd, $square; // or define them inside if they're not global

    $sum = function($carry, $n) {
        return $carry + $n;
    };

    return reduceArray($sum, mapArray($square, filterArray($isOdd, $numbers)), 0);
}

echo processNumbers($numbers); // Output should be the sum of squared odd numbers


