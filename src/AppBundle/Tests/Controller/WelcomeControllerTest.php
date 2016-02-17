<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WelcomeControllerTest extends WebTestCase
{
    // для запуска функционального теста:
    // phpunit -c app src/AppBundle/Tests/Controller/WelcomeControllerTest.php

    // количество тестов определяется количеством методов класса
    // количество утверждений определяется количеством выражений вида $this->assert...
    public function testWelcomeAction()
    {
        // создание объекта клиента теста
        $client = static::createClient();

        // создание объекта запроса
        // The test client simulates an HTTP client like a browser
        // and makes requests into your Symfony application:
        // The request() method takes the HTTP method and a URL as arguments
        // and returns a Crawler instance.
        $crawler = $client->request('GET', '/welcome');

        // тестовое утверждение (означает):
        // страница по адресу .../welcome
        // имеет более нуля фрагментов html-кода,
        // содержащего текст "Welcome"
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Welcome")')->count()
        );

        // ... содержит 1 тэг <body>
        $this->assertCount(1, $crawler->filter('body'));



    }

    public function testWelcomeSlugAction()
    {
        $client = static::createClient();

        // тест будет пройден:
        // метод - GET, 2 - целое число
        $crawler = $client->request('GET', '/optional/2');

        // тест провалится из-за метода POST (допустим только GET)
        // $crawler = $client->request('POST', '/optional/2');

        // тест провалится из-за значения myvalue (не целое число)
        // $crawler = $client->request('GET', '/optional/myvalue');

        // тест провалится из-за значения default (не целое число)
        // $crawler = $client->request('GET', '/optional/default');

        // тест будет пройден:
        // нет параметров, но будет передано значение по умолчанию - defaults={"page" = "default"}
        // $crawler = $client->request('GET', '/optional');

        // Assert that the response status code is 2xx
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testLinkWelcomeAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/welcome');

        // ссылка содержит текст "page"
        $link = $crawler->selectLink('page')->link();

        // для сравнения, код ниже вызовет ошибку
        //$link = $crawler->selectLink('page1')->link();

        // клики по ссылкам не являются утверждениями
        $client->click($link);
    }

    public function testWelcomeFormAction()
    {
        // проверка формы
        $client = static::createClient();
        $crawler = $client->request('POST', '/welcome_form');
        $form = $crawler->selectButton('submit')->form();

        // set some values
        $form['name'] = 'Lucas';

        // submit the form
        $crawler = $client->submit($form);
    }
}