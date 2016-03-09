<?php
/**
 * Created by PhpStorm.
 * User: Eugene
 * Date: 31.01.2016
 * Time: 18:43
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        return new Response(
            '<html><body>Lucky numbers: '.$numbersList.'</body></html>'
        );
    }

    /**
     * @Route("/lucky/templating/{count}")
     */
    public function templatingAction($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        /*
        $html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList)
        );

        return new Response($html);
        */

        // render: a shortcut that does the same as above
        return $this->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList)
        );
    }

    /**
     * Short method description
     *
     * Long method description with some
     * additional information
     *
     * @Route("/lucky/data/{data}")
     */
    public function dataAction($data)
    {
        $myString = "Некая строка с добавлением $data";

        return new Response(
            '<html><body>Строка: '.$myString.'</body></html>'
        );
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        // calls json_encode and sets the Content-Type header
        return new JsonResponse($data);
    }

    /**
     * @Route("lucky/return/value")
     */
    public function luckyReturnValueAction()
    {
        // простой возврат json данных без передачи параметров
        $data = [
            'key1' => 'value 1',
            'key2' => 'value 2',
            'key3' => 'value 3',
            'key4' => 'value 4',
            'key5' => 'value 5',
        ];

        // calls json_encode and sets the Content-Type header
        return new JsonResponse($data);
    }

    /**
     * @Route("lucky/return/webix")
     */
    public function luckyReturnWebixAction()
    {
        // простой возврат json данных без передачи параметров
        $data = [
            [ "sales" => "20", "month" => "Jan", "color" => "#ee3639" ],
            [ "sales" => "30", "month" => "Fen", "color" => "#ee9e36" ],
            [ "sales" => "50", "month" => "Mar", "color" => "#eeea36" ],
            [ "sales" => "40", "month" => "Apr", "color" => "#a9ee36" ],
            [ "sales" => "70", "month" => "May", "color" => "#36d3ee" ],
            [ "sales" => "80", "month" => "Jun", "color" => "#367fee" ],
            [ "sales" => "60", "month" => "Jul", "color" => "#9b36ee" ],
        ];

        // calls json_encode and sets the Content-Type header
        return new JsonResponse($data);
    }

    /**
     * @Route("lucky/return/webix/colors")
     */
    public function luckyReturnWebixColorsAction()
    {
        // простой возврат json данных без передачи параметров
        $data = [
            [ "id" => 1, "sales" => 20, "year" => "02", "color" => "#ee4339" ],
            [ "id" => 2, "sales" => 55, "year" => "03", "color" => "#ee9336" ],
            [ "id" => 3, "sales" => 40, "year" => "04", "color" => "#eed236" ],
            [ "id" => 4, "sales" => 78, "year" => "05", "color" => "#d3ee36" ],
            [ "id" => 5, "sales" => 61, "year" => "06", "color" => "#a7ee70" ],
            [ "id" => 6, "sales" => 35, "year" => "07", "color" => "#58dccd" ],
            [ "id" => 7, "sales" => 80, "year" => "08", "color" => "#36abee" ],
            [ "id" => 8, "sales" => 50, "year" => "09", "color" => "#476cee" ],
            [ "id" => 9, "sales" => 65, "year" => "10", "color" => "#a244ea" ],
            [ "id" => 10, "sales" => 82, "year" => "11", "color" => "#e33fc7" ]
        ];

        // calls json_encode and sets the Content-Type header
        return new JsonResponse($data);
    }

    /**
     * @Route("lucky/modify/{value}")
     */
    public function luckyModifyValueAction($value)
    {
        // возврат json данных с передачей параметров
        // для нормального отображения строки нужно перед отправкой в GET-запросе
        // декодировать строку. А в Symfony раскодировать ее
        $value = urldecode($value);
        $data = [
            'key 1' => 'value 1 ' . $value,
            'key 2' => 'value 2 ' . $value,
            'key 3' => 'value 3 ' . $value,
            'key 4' => 'value 4 ' . $value,
            'key 5' => 'value 5 ' . $value,
        ];

        // calls json_encode and sets the Content-Type header
        return new JsonResponse($data);
    }
}