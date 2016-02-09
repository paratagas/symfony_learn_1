<?php

namespace AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Используется для внутренней логики обработки каких-то данных
 * и их возврата в контроллер, откуда был создан запрос
 *
 */
class InternalController extends Controller
{
    public function resultAction($name, $color)
    {
        return new Response(
            "<html><body>
                <p>Hello, $name</p>
                <p>Your colour is $color</p>
            </body></html>"
        );
    }
}