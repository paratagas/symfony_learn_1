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

/*
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
*/

$newArr = [
    'key 1' => 'value1',
    'key 2' => 'value2',
    'key 3' => 'value3',
    'key 4' => 'value4',
    'key 5' => 'value5',
];

$jsonArr = json_encode($newArr);
echo $jsonArr;