<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


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
    public function welcomeSlugAction($slug, Request $request)
    {
        // значение get переменной page по умолчанию - второй параметр метода get()
        // именно оно выведется, если не передать в url запроса query string ?page=my_page_value
        // если передать query string без значения, например, ?page= , получим пустую строку
        $page = $request->query->get('page', 'default value');

        // for a request to http://example.com/blog/index.php/post/hello-world
        // the path info is "/post/hello-world"
        $path = $request->getPathInfo();

        // возможность перенаправления
        if($page == 'symfony'){
            return $this->redirect('http://symfony.com/doc');
            // другие варианты:
            // redirectToRoute is equivalent to using redirect() and generateUrl() together:
            // return $this->redirect($this->generateUrl('_welcome'));
            // return $this->redirectToRoute('_welcome');
        }

        return $this->render(
            'template/slug.html.twig',
            [
                'slug' => $slug,
                // чтобы получить значение переменной page из запроса методом get
                // route должен быть, например, ...route/{slug}?page=my_page_value
                'page' => $page,
                'path' => $path,
            ]
        );
    }

    /**
     * @Route("/hidden", name="_hidden")
     */
    public function hiddenAction()
    {
        // Перенаправление на другой контроллер с передачей неких значений:
        // InternalController::resultAction() inside the AppBundle
        $name = "John";
        $response = $this->forward('AppBundle:Internal:result', array(
            'name'  => $name,
            'color' => 'green',
        ));

        // ... further modify the response or return it directly

        return $response;
    }

    /**
     * @Route("/optional/{page}", defaults={"page" = "default"}, name="_optional", requirements={"page": "\d+"})
     *
     * Доступ к этому контроллеру возможен только через метод GET
     * В ином случае вылетит ошибка
     * Можно перечислить несколько методов через запятую: {"GET","HEAD"}
     * @Method({"GET"})
     *
     * При попытке перейти на /optional/2 $page примет значение 2
     * При попытке перейти на /optional/myvalue выскочит ошибка, т.к.
     * переданным значением $page может быть только целое число (см. "requirements" и "\d+"),
     * что, впрочем, не касается "defaults":
     * при переходе на /optional $page примет значение "default"
     */
    public function indexAction($page)
    {
        return new Response(
            "<html><body>
            <p>I'm optional page with page value: <b>$page</b></p>
            </body></html>"
        );
    }
}