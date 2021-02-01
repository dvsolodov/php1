<?php

/*
 * Задания 1, 2, 3, 4, 6, 7
 */

/*
 * 1. Объявить две целочисленные переменные $a и $b
 * и задать им произвольные начальные значения. 
 * Затем написать скрипт, который работает по следующему принципу:
 * если $a и $b положительные, вывести их разность;
 * если $а и $b отрицательные, вывести их произведение;
 * если $а и $b разных знаков, вывести их сумму;
 * Ноль можно считать положительным числом.
 */
echo '<h3>Задание 1. Вывод названия математического выражения</h3>';

$a = rand(-5, 5);
$b = rand(-5, 5);

echo getMathExpressionName($a, $b);

function getMathExpressionName($a, $b)
{
    if ($a >= 0 && $b >= 0) {
        return 'Разность';
    } elseif ($a < 0 && $b < 0) {
        return 'Произведение';
    } else {
        return 'Сумма';
    }
}
        
/*
 * 2. Присвоить переменной $а значение в промежутке [0..15].
 * С помощью оператора switch организовать вывод чисел от $a до 15.
 * При желании сделайте это задание через рекурсию.
 */

$a = rand(0, 15);

echo "<h3>Задание 2. Вывод числового ряда от {$a} до 15</h3>";
echo '<h4>С помощью switch-case</h4>';
switch ($a) {
    case 0: echo 0;
    case 1: echo 1;
    case 2: echo 2;
    case 3: echo 3;
    case 4: echo 4;
    case 5: echo 5;
    case 6: echo 6;
    case 7: echo 7;
    case 8: echo 8;
    case 9: echo 9;
    case 10: echo 10;
    case 11: echo 11;
    case 12: echo 12;
    case 13: echo 13;
    case 14: echo 14;
    case 15: echo 15;
}

echo '<h4>С помощью рекурсии</h4>';

getNumberSeriesByRecursion($a);

function getNumberSeriesByRecursion($a)
{
    if ($a >= 0 && $a <= 15) {
        echo $a;
        getNumberSeriesByRecursion($a + 1);
    }
}

/*
 * 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
 * Обязательно использовать оператор return.
 * В делении проверьте деление на 0 и верните текст ошибки.
 */

$x = rand(-10, 10);
$y = rand(-10, 10);

$diff = getDifferece($x, $y);
$prod = getProduct($x, $y);
$sum = getSum($x, $y);
$quot = getQuotient($x, $y);

echo <<<HTML
<h3>Задание 3. Арифметические операции</h3>
<p>\$x = {$x}; \$y = {$y};</p>
<p>Частное двух чисел &ndash; {$quot}</p>
<p>Произведение двух чисел &ndash; {$prod}</p>
<p>Сумма двух чисел &ndash; {$sum}</p>
<p>Разность двух чисел &ndash; {$diff}</p>
HTML;

/**
 * Функция для получения суммы двух чисел
 */
function getSum($x, $y)
{
    return $x + $y;
}

/**
 * Функция для получения разности двух чисел
 */
function getDifferece($x, $y)
{
    return $x - $y;
}

/**
 * Функция для получения частного двух чисел
 */
function getQuotient($x, $y)
{
    return ($y != 0) ? ($x / $y) : 'Ошибка: деление на ноль!!!';
}

/**
 * Функция для получения произведения двух чисел
 */
function getProduct($x, $y)
{
    return $x * $y;
}

/*
 * 4. Реализовать функцию с тремя параметрами: 
 * function mathOperation($arg1, $arg2, $operation), 
 * где $arg1, $arg2 – значения аргументов, 
 * $operation – строка с названием операции. 
 * В зависимости от переданного значения операции выполнить 
 * одну из арифметических операций (использовать функции из пункта 3) 
 * и вернуть полученное значение (использовать switch).
 */

echo '<h3>Задание 4. Вывести результат указанной арифметической операции</h3>';

$arg1 = rand(-100, 100);
$arg2 = rand(-100, 100);
$operations = [
    'Деление' =>'/', 
    'Уможение' => '*', 
    'Сложение' => '+', 
    'Вычитание' => '-',
    'Остаток от деления' => '%',
];
$opKey = array_rand($operations);
$operation = $operations[$opKey];
$result = mathOperation($arg1, $arg2, $operation);

echo <<<HTML
<p>
    arg1 = {$arg1}; arg2 = {$arg2};
    <br>
    Арифметическая операция &ndash; {$opKey}
    <br>
    Результат: {$result}
</p>
HTML;

function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case '/':
            return getQuotient($arg1, $arg2);
            break;
        case '*':
            return getProduct($arg1, $arg2);
            break;
        case '+':
            return getSum($arg1, $arg2);
            break;
        case '-':
            return getDifferece($arg1, $arg2);
            break;
        default:
            return 'Неправильная операция';
    }       
}

/*
 * 6. *С помощью рекурсии организовать функцию возведения числа в степень.
 * Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
 */

echo '<h3>Задание 6*. Вывести результат возведения числа в указанную степень, используя рекурсию</h3>';

$val = rand(100, 100);
$pow = rand(1, 5);
$res = power($val, $pow);

echo "<p>Результатом возведения числа {$val} в степень {$pow} будет {$res}";

function power($val, $pow)
{
    if ($pow > 1) {
        $val *= power($val, $pow - 1);
    }

    return $val;  
}

/*
 * 7. *Написать функцию, которая вычисляет текущее время 
 * и возвращает его в формате с правильными склонениями, например:
 * 22 часа 15 минут
 * 21 час 43 минуты
 */

echo '<h3>Задание 7. Вывести время в правильном склонении</h3>';

$hours = rand(0, 30);
$minutes = rand(0, 70);
$correctTime = getCorrectTimeRecord($hours, $minutes);

if ($correctTime === false) {
    echo "Время: {$hours}:{$minutes}. Некорректные данные";
} else {
    echo "Время: {$hours}:{$minutes}. Полный формат: {$correctTime}.";
}

function getCorrectTimeRecord(string $hours, string $minutes)
{
    $hour = '';
    $minute = '';

    switch (true) {
        case ($hours == 0):
        case ($hours >= 5 && $hours <= 20):
            $hour = 'часов';
            break;
        case ($hours == 1 || $hours == 21):
            $hour = 'час';
            break;
        case ($hours >= 2 && $hours <= 4):
        case ($hours >= 22 && $hours <= 24):
            $hour = 'часа';
            break;
        default:
            return false;
    }

    switch (true) {
        case ($minutes == 0):
        case ($minutes >= 5 && $minutes <= 20):
        case ($minutes >= 25 && $minutes <= 30):
        case ($minutes >= 35 && $minutes <= 40):
        case ($minutes >= 45 && $minutes <= 50):
        case ($minutes >= 55 && $minutes <= 60):
            $minute = 'минут';
            break;
        case ($minutes == 1 || $minutes == 21):
        case ($minutes == 31 || $minutes == 41):
        case ($minutes == 51 || $minutes == 61):
            $minute  = 'минута';
            break;
        case ($minutes >= 2 && $minutes <= 4):
        case ($minutes >= 22 && $minutes <= 24):
        case ($minutes >= 32 && $minutes <= 34):
        case ($minutes >= 42 && $minutes <= 44):
        case ($minutes >= 52 && $minutes <= 54):
            $minute = 'минуты';
            break;
        default:
            return false;
    }

    if ($hour == 24 && $minute > 0) {
        $hour = 0;
    }
    
    return "{$hours} {$hour} {$minutes} {$minute}";
}
