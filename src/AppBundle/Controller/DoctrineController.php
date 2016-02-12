<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Category;

class DoctrineController extends Controller
{
    /**
     * @Route("/doctrine_create", name="doctrine_create")
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('Name 4');
        $product->setPrice('59.99');
        $product->setDescription('Product 4 description');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product with id: ' . $product->getId());
    }

    /**
     * @Route("/doctrine_show/{id}", name="doctrine_show")
     */
    public function showAction($id)
    {
        // Once you have your repository, you have access to all sorts of helpful methods
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

        // query by the primary key (usually "id")
        $product = $repository->find($id);

        // dynamic method names to find based on a column value
        // находит одну запись
        // $product = $repository->findOneById($id);
        // $product = $repository->findOneByName('foo');

        // find *all* products
        // $products = $repository->findAll();

        // find a group of products based on an arbitrary column value
        // находит все записи
        // $products = $repository->findByPrice(59.99);
        // $products = $repository->findByDescription('Product 2 description');

        // query for one product matching by name and price
        /*$products = $repository->findOneBy(
            array('name' => 'Name 2', 'price' => 59.99)
        );*/

        // query for all products matching the name, ordered by price
        $products = $repository->findBy(
            ['price' => 59.99],
            ['name' => 'ASC']
        );

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id: ' . $id
            );
        }

        return $this->render(
            'doctrine/fetch.html.twig',
            [
                'product' => $product,
                'products' => $products,
            ]
        );
    }

    /**
     * @Route("/doctrine_update/{id}", name="doctrine_update")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $product->setName('New product name for id: ' . $id);
        $em->flush();

        // редирект с параметрами
        return $this->redirectToRoute('doctrine_show', array('id' => $id));
    }

    /**
     * @Route("/doctrine_delete/{name}", name="doctrine_delete")
     */
    public function deleteAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findOneByName($name);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for name ' . $name
            );
        }

        $em->remove($product);
        $em->flush();

        // редирект с параметрами
        return $this->redirectToRoute('doctrine_show', array('id' => 1));
    }

    /**
     * @Route("/doctrine_dql", name="doctrine_dql")
     */
    public function dqlAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM AppBundle:Product p
            WHERE p.price > :price
            ORDER BY p.price ASC'
        )->setParameter('price', '19.99');

        $products = $query->getResult();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();

        return $this->render(
            'doctrine/dql.html.twig',
            [
                'products' => $products,
            ]
        );
    }

    /**
     * @Route("/doctrine_query_builder/{price}", name="doctrine_query_builder")
     */
    public function dqbAction($price)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

        // createQueryBuilder automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getResult();

        return $this->render(
            'doctrine/dqb.html.twig',
            [
                'products' => $products,
            ]
        );
    }

    /**
     * @Route("/doctrine_repository", name="doctrine_repository")
     */
    public function dRepAction()
    {
        $em = $this->getDoctrine()->getManager();

        // получение данных из метода, определенного в моем классе-репозитории.
        // ссылка на класс-репозиторий должна быть определена в классе-сущности:
        // Entity(repositoryClass="AppBundle\Entity\ProductRepository")
        // до этого я использовал встроенные методы.
        // findAllOrderedByName() - мой первый кастомный метод выборки данных
        //$products = $em->getRepository('AppBundle:Product')->findAllOrderedByName();
        //$products = $em->getRepository('AppBundle:Product')->myCustomFindByDQL(19.99);
        $products = $em->getRepository('AppBundle:Product')->myCustomFindByQueryBuilder(19.99);

        return $this->render(
            'doctrine/drep.html.twig',
            [
                'products' => $products,
            ]
        );
    }

    /**
     * @Route("/doctrine_related", name="doctrine_related")
     */
    public function dRelatedAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum dolor');

        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id: ' . $product->getId()
            . ' and category id: ' . $category->getId()
        );
    }

    /**
     * @Route("/doctrine_get_category_name", name="doctrine_get_category_name")
     */
    public function dGetCatNameAction()
    {
        // получаем категорию по продукту
        $id = 9;
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        // можно получить имя категории сразу
        $categoryName = $product->getCategory()->getName();
        // а можно получить категорию, а ниже извлечь ее имя
        $category = $product->getCategory();

        //////////////////////
        // и наоборот - продукт по категории:
        $cat_id = 1;
        $category_reversed = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->find($cat_id);

        // массив продуктов
        $products_reversed = $category_reversed->getProducts();

        return new Response(
            '1 PART: Fetched product id: ' . $product->getId()
            . ' with category name: ' . $categoryName
            . ' with category name again: ' . $category->getName()
            . ' 2 PART: Fetched category name: ' . $category_reversed->getName()
            . ' with product name again: ' . $products_reversed[0]->getName()
        );
    }

    /**
     * @Route("/doctrine_joined", name="doctrine_joined")
     */
    public function dJoinedAction()
    {
        $id = 9;
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneByIdJoinedToCategory($id);

        $category = $product->getCategory();

        return new Response(
            'Fetched category name: ' . $category->getName()
            . ' with product name: ' . $product->getName()
        );
    }
}