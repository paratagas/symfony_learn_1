<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Author;

class ValidationController extends Controller
{
    /**
     * @Route("/validation_base", name="_validation_base")
     */
    public function authorAction()
    {
        $author = new Author();

        // ... do something to the $author object

        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            // простой вывод в браузер
            //$errorsString = (string) $errors;
            //return new Response($errorsString);

            // вывод в шаблон
            return $this->render('author/validation.html.twig', array(
                'errors' => $errors,
            ));
        }

        return new Response('The author is valid! Yes!');
    }
}