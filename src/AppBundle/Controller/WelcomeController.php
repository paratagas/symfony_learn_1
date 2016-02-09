<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class WelcomeController extends Controller
{
    /**
    * @Route("/welcome", name="_welcome")
    */
    public function welcomeAction()
    {
        return new Response(
            "<html><body>I'm Welcome page</body></html>"
        );
    }

    /**
    * @Route("/welcome/{slug}", name="_welcome_slug")
    */
    public function welcomeSlugAction($slug)
    {
        return $this->render(
            'template/slug.html.twig',
            [
                'slug' => $slug,
            ]
        );
    }
}