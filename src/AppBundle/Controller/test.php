<?php

function someFunc($param_1, $param_2)
{
    $param_1 .= " Now added to parameter 1";
    $param_2 .= " Now added to parameter 2";
    return $param_1 . $param_2;
}

function anotherFunc($param_1)
{
    $param_1 .= " Now added to parameter 1";
    return $param_1;
}

// php 7
// Integers
echo 1 <=> 1; // 0
echo PHP_EOL;
echo 1 <=> 2; // -1
echo PHP_EOL;
echo 2 <=> 1; // 1
echo PHP_EOL;

// Floats
echo 1.5 <=> 1.5; // 0
echo PHP_EOL;
echo 1.5 <=> 2.5; // -1
echo PHP_EOL;
echo 2.5 <=> 1.5; // 1
echo PHP_EOL;

// Strings
echo "a" <=> "a"; // 0
echo PHP_EOL;
echo "a" <=> "b"; // -1
echo PHP_EOL;
echo "b" <=> "a"; // 1
echo PHP_EOL;