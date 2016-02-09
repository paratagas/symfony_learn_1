<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{
    /**
     * @Route("/template/child")
     */
    public function templateAction()
    {
        $articles = [
            ['title' => 'Article 1', 'authorName' => 'Author 1', 'content' => 'Content 1'],
            ['title' => 'Article 2', 'authorName' => 'Author 2', 'content' => 'Content 2'],
            ['title' => 'Article 3', 'authorName' => 'Author 3', 'content' => 'Content 3'],
        ];

        $blog_entries = [
            ['title' => 'Title 1', 'body' => 'Body 1'],
            ['title' => 'Title 2', 'body' => 'Body 2'],
            ['title' => 'Title 3', 'body' => 'Body 3'],
        ];

        return $this->render(
            'template/child.html.twig',
            [
                'blog_entries' => $blog_entries,
                'articles' => $articles,
            ]
        );
    }
}