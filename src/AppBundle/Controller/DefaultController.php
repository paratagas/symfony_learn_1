<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/admin", name="_admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/role_user", name="_role_user")
     * @Security("has_role('ROLE_USER')")
     */
    public function roleUserAction()
    {
        // можно прописать права доступа так:
        // $this->denyAccessUnlessGranted('ROLE_USER', null, 'Что-то не заходится внутрь!');
        // но лучше сделать это в аннотации, подключив Security
        return new Response('<html><body>Role User page!</body></html>');
    }
}
