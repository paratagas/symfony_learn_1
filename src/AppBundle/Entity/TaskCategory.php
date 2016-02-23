<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class TaskCategory
{
    /**
    * @Assert\NotBlank()
    */
    public $name;
}