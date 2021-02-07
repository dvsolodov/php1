<?php

/*
 * Урок 2. Задания 1, 2, 3, 4, 5, 6, 7, 8, 9
 */

/*
 * 1. С помощью цикла while вывести все числа в промежутке от 0 до 100,
 * которые делятся на 3 без остатка.
 */

function getOddNumbersSeries(int $start, int $end): string
{
    $result = '';
    $i = $start;

    while ($i <= $end) {
        if ($i % 3 == 0) {
            $result .= "{$i}, ";
        }

        $i++;
    }
    
    return substr($result, 0, -2); 
}

/*
 * 2. С помощью цикла do...while написать функцию
 * для вывода чисел от 0 до 10, чтобы результат
 * выглядел так:
 * 0 – это ноль.
 * 1 – нечётное число.
 * 2 – чётное число.
 * 3 – нечётное число.
 * ...
 */

function getOddAndEvenNumbersSeries(int $start, int $end): string
{
    $i = $start;

    do {
        if ($i == 0) {
            $result = '0 - это ноль.<br>';
        } elseif ($i % 2 == 0) {
            $result .= "{$i} - это чётное число.<br>";
        } else {
            $result .= "{$i} - это нечётное число.<br>";
        }

        $i++;
    } while ($i <= $end);
    
    return $result;
}

/*
 * 3. Объявить массив, в котором в качестве ключей будут использоваться
 * названия областей, а в качестве значений – массивы с названиями городов
 * из соответствующей области.
 * Вывести в цикле значения массива, чтобы результат был таким:
 * Московская область:
 * Москва, Зеленоград, Клин.
 * Ленинградская область:
 * Санкт-Петербург, Всеволожск, Павловск, Кронштадт.
 * Рязанская область...(названия городов можно найти на maps.yandex.ru)
 */

function getRegionCities(array $array): string
{
    $regionCities = '';

    foreach ($array as $region => $cities) {
        $regionCities .= "{$region}:<br>";

        foreach ($cities as $city) {
            $regionCities .= "{$city}, ";
        }

        $regionCities = mb_substr($regionCities, 0, -2) . '.<br>';
    }

    return $regionCities;
}

/*
 * 4. Объявить массив, индексами которого являются буквы русского языка, 
 * а значениями – соответствующие латинские буквосочетания 
 * (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, ..., 
 * ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
 * Написать функцию транслитерации строк.
 */

function getTranslit(string $rusString, array $transAlphabet): string
{
    $rusStringArr = mb_str_split($rusString);

    foreach ($rusStringArr as $key => $letter) {
        if (isset($transAlphabet[$letter])) {
            $rusStringArr[$key] = $transAlphabet[$letter];
        } elseif (isset($transAlphabet[mb_strtolower($letter)])) {
            $rusStringArr[$key] = ucwords($transAlphabet[mb_strtolower($letter)]);
        }
    }

    return implode('', $rusStringArr);

    // Или тело функции заменить на эту строку, если в $transAlphabet
    // будут элементы с заглаными буквами
	//return strtr($rusString, $transAlphabet);
}

/*
 * 5. Написать функцию, которая заменяет в строке пробелы 
 * на подчеркивания и возвращает видоизмененную строчку.
 */

function convertWhiteSpaceToUnderline(string $string): string
{
    $arr = explode(' ', $string);

    return implode('_', $arr);
}

/*
 * 7. *Вывести с помощью цикла for числа от 0 до 9, 
 * НЕ используя тело цикла. Выглядеть это
 * должно так:
 * for (...) { // здесь пусто}
 */

function getNumSeries($start, $end): string
{
    for ($i = $start, $result = ''; $i <= $end; $result .= $i++){}

    return $result;
}

/*
 * 8. *Повторить третье задание, но вывести на экран только города,
 * начинающиеся с буквы «К».
 */

function getRegionCitiesByLetter(array $array, string $letter): string
{
    $regionCities = '';

    foreach ($array as $region => $cities) {
        $regionCities .= "{$region}:<br>";

        foreach ($cities as $city) {
            if (mb_substr($city, 0, 1) == $letter) {
                $regionCities .= "{$city}, ";
            }
        }

        $regionCities = mb_substr($regionCities, 0, -2) . '.<br>';
    }

    return $regionCities;
}

/*
 * 9. *Объединить две ранее написанные функции в одну,
 * которая получает строку на русском языке, производит транслитерацию
 * и замену пробелов на подчеркивания (аналогичная задача решается 
 * при конструировании url-адресов на основе названия статьи в блогах).
 */

function convertToChPU(string $rusString, array $transAlphabet)
{
    $translit = getTranslit($rusString, $transAlphabet);

    return convertWhiteSpaceToUnderline($translit); 
}

$result1 = getOddNumbersSeries(0, 100);

$result2 = getOddAndEvenNumbersSeries(0, 10);

$arr = [
    'Московская область' => [
        'Москва',
        'Зеленоград',
        'Клин',
    ],
    'Ленинградская область' => [
        'Санкт-Петербург',
        'Всеволожск',
        'Павловск',
        'Кронштадт',
    ],
    'Рязанская область' => [
        'Рязань',
        'Касимов',
        'Сасово',
        'Скопин',
    ],
];
$result3 = getRegionCities($arr); 

//массив составлен в соответствии с ГОСТ 7.79-2000 (система Б)
//http://docs.cntd.ru/document/1200026226
$transAlphabet = [ 
    'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
    'Е' => 'E',    'Ё' => 'Yo',   'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
    'Й' => 'J',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
    'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
    'У' => 'U',    'Ф' => 'F',    'Х' => 'X',    'Ц' => 'Cz',   'Ч' => 'Ch',
    'Ш' => 'Sh',   'Щ' => 'Shh',  'Ъ' => '``',   'Ы' => 'Y`',   'Ь' => '`',
    'Э' => 'E`',   'Ю' => 'Yu',   'Я' => 'Ya',   

    'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
    'е' => 'e',    'ё' => 'yo',   'ж' => 'zh',   'з' => 'z',    'и' => 'i',
    'й' => 'j',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
    'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
    'у' => 'u',    'ф' => 'f',    'х' => 'x',    'ц' => 'cz',   'ч' => 'ch',
    'ш' => 'sh',   'щ' => 'shh',  'ъ' => '``',   'ы' => 'y`',   'ь' => '`',
    'э' => 'e`',   'ю' => 'yu',   'я' => 'ya',
];
$transAlphabet = [
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
];
$string = 'Глокая куздра штеко будланула бокра и курдячит бокрёнка.';
$result4 = getTranslit($string, $transAlphabet);

$result5 = convertWhiteSpaceToUnderline($string);

$result7 = getNumSeries(0, 9);

$result8 = getRegionCitiesByLetter($arr, 'К');

$result9 = convertToChPU($string, $transAlphabet);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задания урока 3</title>
</head>
<body>
    <section>
        <h3>Задание 1. Вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.</h3>
        <p><?= $result1 ?></p>
    </section>
    <section>
        <h3>Задание 2. Вывести все числа в промежутке от 0 до 10 с указанием чётности или нечётности.</h3>
        <p><?= $result2 ?></p>
    </section>
    <section>
        <h3>Задание 3. Вывести области с их городами.</h3>
        <p><?= $result3 ?></p>
    </section>
    <section>
        <h3>Задание 4. Вывести перевод на транслит строки <a href="https://ru.wikipedia.org/wiki/%D0%93%D0%BB%D0%BE%D0%BA%D0%B0%D1%8F_%D0%BA%D1%83%D0%B7%D0%B4%D1%80%D0%B0">"Глокая куздра штеко будланула бокра и курдячит бокрёнка"</a>.</h3>
        <p><?= $result4 ?></p>
    </section>
    <section>
        <h3>Задание 5. Заменить в строке пробелы на подчеркивания.</h3>
        <p><?= $result5 ?></p>
    </section>
    <section>
        <h3>Задание 7. Вывести числа от 0 до 9, не используя тела цикла.</h3>
        <p><?= $result7 ?></p>
    </section>
    <section>
        <h3>Задание 8. Вывести области с их городами, начинающимися на букву К.</h3>
        <p><?= $result8; ?></p>
    </section>
    <section>
        <h3>Задание 9. Вывести перевод на транслит строки <a href="https://ru.wikipedia.org/wiki/%D0%93%D0%BB%D0%BE%D0%BA%D0%B0%D1%8F_%D0%BA%D1%83%D0%B7%D0%B4%D1%80%D0%B0">"Глокая куздра штеко будланула бокра и курдячит бокрёнка"</a> с заменой пробелов подчеркиванием.</h3>
        <p><?= $result9; ?></p>
    </section>
</body>
</html>
