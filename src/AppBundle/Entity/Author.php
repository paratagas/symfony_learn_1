<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    /**
     * @Assert\NotBlank()
     */
    public $name = "Name"; // завершится успешно
    //public $name; // сгенерирует ошибку

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     * @Assert\Choice(
     *     choices = { "male", "female", "other" },
     *     message = "Choose a valid gender."
     * )
     */
    public $gender = "ge";
}