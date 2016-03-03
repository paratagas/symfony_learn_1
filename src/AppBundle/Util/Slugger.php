<?php

namespace AppBundle\Util;

// классы из Util можно использовать как инструкцией use,
// так и в качестве сервисов
class Slugger
{
    public function slugify($string)
    {
        return preg_replace(
            '/[^a-z0-9]/', '-', strtolower(trim(strip_tags($string)))
        );
    }
}