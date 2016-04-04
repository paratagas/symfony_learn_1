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
     * Используется в http://localhost/webix_api/courses.html
     * Webix подтягивает эти данные и выводит на страницу
     *
     * @Route("lucky/return/webix/dollar")
     */
    public function luckyReturnWebixDollar()
    {
        // полное содержимое пропарсенных файлов
        $files = [];

        // массив курсов
        $courses = [];

        // массив с выходными данными в формате:
        // year, color, course
        $dataCourses = [];

        $yearQuarter = 1;
        // с этого года начнется построение графика
        $pagesYear = 2002;
        // месяц-день
        $date = "02-01";
        $patternUrl = "http://finance.tut.by/arhiv/?currency=USD&from=";
        $newPages = [];
        // установим значение счетчика от 0 до 29
        // то есть на 29 полугодий (14,5 лет)
        for ($i = 0; $i < 29; $i++) {
            // создание строки вида 2002-1
            $wholeYear = strval($pagesYear) . "-" . strval($yearQuarter);
            // полный URL, имеет вид:
            // http://finance.tut.by/arhiv/?currency=USD&from=2002-02-01&to=2002-02-01
            $wholeUrl = $patternUrl . strval($pagesYear) . "-" . $date . "&to=" . strval($pagesYear) . "-" . $date;
            // структуру данных см. в массиве $pages
            $newPages[$wholeYear] = $wholeUrl;

            if ($yearQuarter == 1) {
                // переключение на 2-ое полугодие
                $yearQuarter = 2;
                // переключение на дату: 01 августа
                $date = "08-01";
            } else {
                // обратное переключение на 1-ое полугодие
                $yearQuarter = 1;
                // обратное переключение на дату: 01 февраля
                $date = "02-01";
                // увеличение значения года на 1 после прохождения 2-го полугодия
                $pagesYear++;
            }
        }

        // образец массива данных, созданных вручную до использования цикла for выше
        /*$pages = [
            "2002-1" => "http://finance.tut.by/arhiv/?currency=USD&from=2002-02-01&to=2002-02-01",
            "2002-2" => "http://finance.tut.by/arhiv/?currency=USD&from=2002-08-01&to=2002-08-01",
            "2003-1" => "http://finance.tut.by/arhiv/?currency=USD&from=2003-02-01&to=2003-02-01",
            "2003-2" => "http://finance.tut.by/arhiv/?currency=USD&from=2003-08-01&to=2003-08-01"
        ];*/

        // цвета для полосок гистограммы
        $colors = [
            "#ee4339", "#ee9336", "#eed236", "#d3ee36", "#a7ee70",
            "#58dccd", "#36abee", "#476cee", "#a244ea", "#e33fc7",
            "#ee4339", "#ee9336", "#eed236", "#d3ee36", "#a7ee70",
            "#ee4339", "#ee9336", "#eed236", "#d3ee36", "#a7ee70",
            "#58dccd", "#36abee", "#476cee", "#a244ea", "#e33fc7",
            "#ee4339", "#ee9336", "#eed236", "#d3ee36"
        ];

        $count = 0;
        foreach ($newPages as $year => $page) {
            $files[$year] = file_get_contents($page);
            $dataCourses[$count]["year"] = strval($year);
            $dataCourses[$count]["number"] = $count + 1;
            $dataCourses[$count]["url"] = $page;
            $count++;
        }

        foreach ($files as $year => $pageContent) {
            // часть строки, находящаяся перед курсом
            $patternString = "</td><td><b>";
            // находим нужную строку
            $courseString = strstr($pageContent, $patternString);
            // обрезаем слева
            $courseString = ltrim($courseString, "</td><td><b>");
            // возвращаем нужное количество символов с начала строки
            $courseString = substr($courseString, 0, 6);
            // удаляем следующий символ открытия тега для четырехначных курсов
            $course = rtrim($courseString, "<");
            // заменяем пробел в середине числа на пустую строку
            // то есть попросту удаляем его для корректного перевода в число
            $course = str_replace(" ", "", $course);
            $courses[] = $course;
        }

        $count = 0;
        foreach ($colors as $color) {
            $dataCourses[$count]["color"] = $color;
            $count++;
        }

        $count = 0;
        foreach ($courses as $course) {
            $dataCourses[$count]["course"] = intval($course);
            $count++;
        }

        return new JsonResponse($dataCourses);
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