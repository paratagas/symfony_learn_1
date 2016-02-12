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