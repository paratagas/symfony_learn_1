<?php
// Тест моего собственного REST-API:

// Symfony на своем домене создает данные и возвращает чистый json.
// Этот скрипт, находясь на своем домене, соединяется с доменом Symfony,
// получает данные и декодирует в массив (или объект), с которым можно работать.
// Отсюда можно передавать какие-либо данные, например, в параметре GET-запроса,
// и они будут динамически обработаны и возвращены (зависит от настроек конкретного route Symfony).
// Теоретически я могу подключать к домену Symfony несколько скриптов или приложений,
// и каждое из них будет использовать данные для своих нужд.
// Более того, я могу принимать и использовать эти данные не только средствами PHP,
// но и, например, Angular, Java или Python и выводить их в одностраничные JS-приложения,
// консольные утилиты и десктопные программы.

// простой запрос без передачи параметров:
$content = file_get_contents('http://localhost/symfony_learn_1/web/app_dev.php/lucky/return/value');

// для получения данных json в понятной PHP форме нужно использовать json_decode()
// второй параметр позволяет получать массивы данных, а не объекты
$content = json_decode($content, true);

echo "<h2>Без передачи параметра</h2>";

foreach ($content as $param => $value) {
	echo "Параметр: <b>$param</b><br/>";
	echo "Значение: <b>$value</b><br/><br/>";
}

// запрос с передачей параметров:
$request = "Добавочная тестовая строка";

// для нормального отображения строки нужно перед отправкой в GET-запросе
// декодировать строку, а в Symfony раскодировать
$param = urlencode($request);

// route Symfony имеет вид lucky/modify/{value}
// где {value} - передаваемый параметр
$url = 'http://localhost/symfony_learn_1/web/app_dev.php/lucky/modify/';
$contentWithParam = file_get_contents($url . $param);

$contentWithParam = json_decode($contentWithParam, true);

echo "<h2>С передачей параметра</h2>";

foreach ($contentWithParam as $param => $value) {
	echo "Параметр: <b>$param</b><br/>";
	echo "Значение: <b>$value</b><br/><br/>";
}