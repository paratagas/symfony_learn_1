<?php

namespace AppBundle\Util;

// классы из Util можно использовать как инструкцией use,
// так и в качестве сервисов
class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}