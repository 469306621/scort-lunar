<?php
// Generator

function myRangeKeys($max = 100)
{
    for ($i = 1; $i <= $max; $i++) {
        yield $i;
    }
}

function myRange2($max = 100) {
    $res = [];
    for ($i = 1; $i <= $max; $i++) {
        $res[] = $i;
    }

    return $res;
}

function myRange($max = 100)
{
    foreach (myRange2($max) as $i) {
        echo $i . PHP_EOL;
    }
}

myRange(PHP_INT_MAX);