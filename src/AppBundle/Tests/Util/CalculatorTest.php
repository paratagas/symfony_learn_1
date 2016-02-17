<?php

namespace AppBundle\Tests\Util;

use AppBundle\Util\Calculator;

// для запуска тестов:
//
// run all tests of the application
// phpunit -c app
//
// run all tests in the Util directory
// phpunit -c app src/AppBundle/Tests/Util
//
// run tests for the Calculator class
// phpunit -c app src/AppBundle/Tests/Util/CalculatorTest.php
//
// run all tests for the entire Bundle
// phpunit -c app src/AppBundle/

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    // модульный тест, проверяющий метод add класса Calculator
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}